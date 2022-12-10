
import { BodegaService } from './../../../data/services/api/bodega.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';

import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import { IBodega } from './bodega.metadata';
import { CiudadService } from '@data/services/api/ciudad.service';
import { DireccionService } from '@data/services/api/direccion.service';
import Swal from 'sweetalert2';
@Component({
  selector: 'app-bodega',
  templateUrl: './bodega.component.html',
  styleUrls: ['./bodega.component.css']
})
export class BodegaComponent implements OnInit {
  closeResult: string | undefined;
  bodega: IBodega = {
    id_bod: 0,
    nombre_bod: '',
    estado_bod: '',
    telef_bod: '',
    cel_bod: '',
    nomb_contac_bod: '',
    fechaini_bod: '',
    fechafin_bod: '',
    id_ciudad: 0,
    direccion_bod: '',
  };
  bodegas: any = [];
  ciudades: any = [];
  direcciones: any = [];
  @ViewChild('bodegaModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalBodega: NgbModal, private bodegaservice: BodegaService, private ciudadservice: CiudadService, private direccionesservice: DireccionService) { }

  ngOnInit(): void {
    this.getBodegas();
    this.getCiudades();
    this.getDireciones();
  }
  getBodegas() {
    this.bodegaservice.getallBodegas().subscribe(bodegas => this.bodegas = bodegas);
  }
  getCiudades() {
    this.ciudadservice.getallCiudades().subscribe(ciudades => this.ciudades = ciudades);
  }
  getDireciones() {
    this.direccionesservice.getallDirecciones().subscribe(direcciones => this.direcciones = direcciones);
  }
  // Boton para abrir ventana modal
  open(content: any) {
    this.modalBodega.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
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
  public editBodega(bodega: any) {
    this.bodega.id_bod = bodega.id_bod;
    this.bodega.nombre_bod = bodega.nombre_bod;
    this.bodega.estado_bod = bodega.estado_bod,
      this.bodega.telef_bod = bodega.telef_bod;
    this.bodega.cel_bod = bodega.cel_bod;
    this.bodega.nomb_contac_bod = bodega.nomb_contac_bod;
    this.bodega.fechaini_bod = bodega.fechaini_bod;
    this.bodega.fechafin_bod = bodega.fechafin_bod;
    this.bodega.id_ciudad = bodega.id_ciudad;
    this.bodega.direccion_bod = bodega.dirreccion_bod;
    this.edit = true;
    this.open(this.modal);
  }
  public borrarBodega(id_bod: number) {
    this.bodegaservice.deleteBodega(id_bod).subscribe((res: any) => {
      this.modalBodega.dismissAll();
      this.getBodegas();
      this.limpiar();
    })
  }
  public saveBodega() {
    (this.edit ? this.updateBodega() : this.storeBodega());
  }
  public updateBodega() {
    this.bodegaservice.updateBodega(this.bodega).subscribe((res: any) => {
      this.modalBodega.dismissAll();
      this.getBodegas();
      this.limpiar();
      Swal.fire({
        title:'Bodega',
        text:'Bodega Actualizada Exitosamente',
        icon:'success'
      });
    })
  }
  public storeBodega() {
    this.bodegaservice.saveBodega(this.bodega).subscribe((res: any) => {
      this.modalBodega.dismissAll();
      this.getBodegas();
      this.limpiar();
      Swal.fire({
        title:'Bodega',
        text:'Bodega Creada Exitosamente',
        icon:'success'
      });
    })
  }
  private limpiar() {
    this.bodega.id_bod = 0;
    this.bodega.nombre_bod = '';
    this.bodega.estado_bod = '',
      this.bodega.telef_bod = '';
    this.bodega.cel_bod = '';
    this.bodega.nomb_contac_bod = '';
    this.bodega.fechaini_bod = '';
    this.bodega.fechafin_bod = '';
    this.bodega.id_ciudad = 0;
    this.bodega.direccion_bod = '';
  }

}
