import { ProvinciaService } from './../../../../data/services/api/provincia.service';
import { CiudadService } from './../../../../data/services/api/ciudad.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { ICiudad } from './ciudad.metadata';
import { Component, OnInit, ElementRef, ViewChild } from '@angular/core';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-ciudad',
  templateUrl: './ciudad.component.html',
  styleUrls: ['./ciudad.component.css']
})
export class CiudadComponent implements OnInit {
  closeResult: string | undefined;
  ciudad:ICiudad={
    id_ciudad:0,
    nombre_ciudad:'',
    estado_ciudad:'',
    id_provincia:0,
  }
  ciudades:any=[];
  provincias:any=[];
  @ViewChild('ciudadModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalCiudad: NgbModal, private ciudadservice: CiudadService, private provinciasservices:ProvinciaService) { }

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
    this.ciudad.id_ciudad = ciudad.id_ciudad;
    this.ciudad.nombre_ciudad = ciudad.nombre_ciudad;
    this.ciudad.estado_ciudad = ciudad.estado_ciudad;
    this.ciudad.id_provincia = ciudad.id_provincia;
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
  public saveCiudad() {
    (this.edit ? this.updateCiudad() : this.storeCiudad());
  }
  public updateCiudad() {
    this.ciudadservice.updateCiudad(this.ciudad).subscribe((res: any) => {
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
    this.ciudadservice.saveCiudad(this.ciudad).subscribe((res: any) => {
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
    this.ciudad.id_ciudad = 0;
    this.ciudad.nombre_ciudad = "";
    this.ciudad.estado_ciudad = "";
    this.ciudad.id_provincia=0;
  }

}
