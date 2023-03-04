import { ProvinciaService } from './../../../../data/services/api/provincia.service';
import { CiudadService } from './../../../../data/services/api/ciudad.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { ICiudad } from './ciudad.metadata';
import { Component, OnInit, ElementRef, ViewChild } from '@angular/core';
import Swal from 'sweetalert2';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-ciudad',
  templateUrl: './ciudad.component.html',
  styleUrls: ['./ciudad.component.css']
})
export class CiudadComponent implements OnInit {
  closeResult: string | undefined;
  public ciudadForm: FormGroup;
  ciudades:any=[];
  provincias:any=[];
  @ViewChild('ciudadModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalCiudad: NgbModal, private ciudadservice: CiudadService, private provinciasservices:ProvinciaService,private formBuilder: FormBuilder) {
    this.ciudadForm = this.formBuilder.group({
      id_ciudad: [''],
      nombre_ciudad: ['',Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      estado_ciudad: ['', Validators.required, Validators.minLength(1), Validators.maxLength(1)],
      id_provincia: ['', Validators.required]
    });
   }

  ngOnInit(): void {
    this.getCiudades();
    this.getProvincias();
  }
  getProvincias() {
    this.provinciasservices.getallProvinciaes().subscribe(provincias => this.provincias = provincias);
  }
  getCiudades() {
    this.ciudadservice.getallCiudades().subscribe(ciudades => this.ciudades = ciudades);
  }
   // Boton para abrir ventana modal
   open(content: any) {
    this.modalCiudad.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
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
  public editCiudad(ciudad: any) {
    this.ciudadForm.setValue({id_ciudad : ciudad.id_ciudad,
    nombre_ciudad : ciudad.nombre_ciudad,
    estado_ciudad : ciudad.estado_ciudad,
    id_provincia : ciudad.id_provincia});
    this.edit = true;
    this.open(this.modal);
  }
  public borrarCiudad(id_ciudad: number) {
    this.ciudadservice.deleteCiudad(id_ciudad).subscribe((res: any) => {
      this.modalCiudad.dismissAll();
      this.getCiudades();
      this.limpiar();
    })
  }
  get f(){
    return this.ciudadForm.controls;
  }
  public saveCiudad() {
    if (!this.ciudadForm.valid) {
      return;
    }
    else {
      (this.edit ? this.updateCiudad() : this.storeCiudad());
    }
  }
  public updateCiudad() {
    this.ciudadservice.updateCiudad(this.ciudadForm.value).subscribe((res: any) => {
      this.modalCiudad.dismissAll();
      this.getCiudades();
      this.limpiar();
      Swal.fire({
        title:'Ciudad',
        text:'Ciudad Actualizada Exitosamente',
        icon:'success'
      });
    })

  }
  public storeCiudad() {
    this.ciudadservice.saveCiudad(this.ciudadForm.value).subscribe((res: any) => {
      this.modalCiudad.dismissAll();
      this.getCiudades();
      this.limpiar();
      Swal.fire({
        title:'Ciudad',
        text:'Ciudad Creada Exitosamente',
        icon:'success'
      });
    })
  }
  private limpiar() {
    this.ciudadForm.reset();
  }

}
