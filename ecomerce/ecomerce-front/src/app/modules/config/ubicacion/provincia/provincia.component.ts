import { ProvinciaService } from './../../../../data/services/api/provincia.service';
import { PaisService } from './../../../../data/services/api/pais.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { IProvincia } from './provincia.metadata';
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-provincia',
  templateUrl: './provincia.component.html',
  styleUrls: ['./provincia.component.css']
})
export class ProvinciaComponent implements OnInit {
  closeResult: string | undefined;
  provincia:IProvincia={
    id_provincia:0,
    nombre_provincia:'',
    estado_prov:'',
    id_pais:0
  }
  provincias:any=[];
  paises:any = [];
  @ViewChild('provinciaModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalProvincia: NgbModal, private paisservice:PaisService, private provinciaservice:ProvinciaService) { }

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
      this.provincia.id_provincia = provincia.id_provincia;
      this.provincia.nombre_provincia = provincia.nombre_provincia;
      this.provincia.id_pais=provincia.id_pais;
      this.provincia.estado_prov = provincia.estado_prov;
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
      (this.edit ? this.updateProvincia() : this.storeProvincia());
    }
    public updateProvincia() {
      this.provinciaservice.updateProvincia(this.provincia).subscribe((res: any) => {
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
    public storeProvincia() {
      this.provinciaservice.saveProvincia(this.provincia).subscribe((res: any) => {
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
      this.provincia.id_provincia = 0;
      this.provincia.nombre_provincia = "";
      this.provincia.estado_prov = "";
    }


}
