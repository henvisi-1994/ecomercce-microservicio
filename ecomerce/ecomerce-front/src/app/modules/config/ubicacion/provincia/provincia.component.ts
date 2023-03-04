import { ProvinciaService } from './../../../../data/services/api/provincia.service';
import { PaisService } from './../../../../data/services/api/pais.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { IProvincia } from './provincia.metadata';
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import Swal from 'sweetalert2';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-provincia',
  templateUrl: './provincia.component.html',
  styleUrls: ['./provincia.component.css']
})
export class ProvinciaComponent implements OnInit {
  closeResult: string | undefined;
  public provinciaForm: FormGroup;
  provincias:any=[];
  paises:any = [];
  @ViewChild('provinciaModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalProvincia: NgbModal, private paisservice:PaisService, private provinciaservice:ProvinciaService,private formBuilder: FormBuilder) {
    this.provinciaForm = this.formBuilder.group({
      id_provincia: [''],
      nombre_provincia: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      estado_prov: ['', Validators.required, Validators.minLength(1), Validators.maxLength(1)],
      id_pais:['', Validators.required]
    });

   }

  ngOnInit(): void {
    this.getProvincias();
    this.getPaises();
  }
  public getPaises(){
    this.paisservice.getallPaises().subscribe(paises => this.paises = paises);
  }
  public getProvincias(){
    this.provinciaservice.getallProvinciaes().subscribe(provincias => this.provincias = provincias);
  }
    // Boton para abrir ventana modal
    open(content: any) {
      this.modalProvincia.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
        this.closeResult = `Closed with: ${result}`;
      }, (reason) => {
        this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
      });
    }
    // Cierra Ventana modal
    private getDismissReason(reason: any): string {
      if (reason === ModalDismissReasons.ESC) {
        return 'by pressing ESC';
      } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
        return 'by clicking on a backdrop';
      } else {
        return `with: ${reason}`;
      }
    }
    public editProvincia(provincia: any) {
      this.provinciaForm.setValue({id_provincia : provincia.id_provincia,
      nombre_provincia : provincia.nombre_provincia,
      id_pais:provincia.id_pais,
      estado_prov : provincia.estado_prov});
      this.edit = true;
      this.open(this.modal);
    }
    public borrarProvincia(id_provincia: number) {
      this.provinciaservice.deleteProvincia(id_provincia).subscribe((res: any) => {
        this.modalProvincia.dismissAll();
        this.getProvincias();
        this.limpiar();
      })
    }
    public saveProvincia() {
      if (!this.provinciaForm.valid) {
        return;
      }
      else {
        (this.edit ? this.updateProvincia() : this.storeProvincia());
      }
    }
    public updateProvincia() {
      this.provinciaservice.updateProvincia(this.provinciaForm.value).subscribe((res: any) => {
        this.modalProvincia.dismissAll();
        this.getProvincias();
        this.limpiar();
        Swal.fire({
          title:'Provincia',
          text:'Provincia Actualizado Exitosamente',
          icon:'success'
        });
      })

    }
    get f(){
      return this.provinciaForm.controls;
    }
    public storeProvincia() {
      this.provinciaservice.saveProvincia(this.provinciaForm.value).subscribe((res: any) => {
        this.modalProvincia.dismissAll();
        this.getProvincias();
        this.limpiar();
        Swal.fire({
          title:'Provincia',
          text:'Provincia Creada Exitosamente',
          icon:'success'
        });
      })
    }
    private limpiar() {
      this.provinciaForm.reset();
    }


}
