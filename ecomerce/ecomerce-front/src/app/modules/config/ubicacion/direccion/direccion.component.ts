import { CiudadService } from './../../../../data/services/api/ciudad.service';
import { DireccionService } from './../../../../data/services/api/direccion.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { IDireccion } from './direccion.metadata';
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-direccion',
  templateUrl: './direccion.component.html',
  styleUrls: ['./direccion.component.css']
})
export class DireccionComponent implements OnInit {
  closeResult: string | undefined;
  direccion:IDireccion={
    id_direccion:0,
    direcion:'',
    calle:'',
    numero:'',
    piso:'',
    telefono:'',
    movil:'',
    estado_direccion:'',
    id_ciudad:0
  }
  direcciones:any=[];
  ciudades:any=[];
  @ViewChild('direccionModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalDireccion: NgbModal, private direccionesservice: DireccionService, private ciudadservice:CiudadService) { }

  ngOnInit(): void {
    this.getDireciones();
    this.getCiudades();
  }
  getCiudades() {
    this.ciudadservice.getallCiudades().subscribe(ciudades => this.ciudades = ciudades);
  }
  getDireciones() {
    this.direccionesservice.getallDirecciones().subscribe(direcciones => this.direcciones = direcciones);
  }
   // Boton para abrir ventana modal
   open(content: any) {
    this.modalDireccion.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
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
  public editDireccion(direccion: any) {
    this.direccion.id_direccion = direccion.id_direccion;
    this.direccion.direcion = direccion.direcion;
    this.direccion.calle = direccion.calle;
    this.direccion.numero = direccion.numero;
    this.direccion.piso = direccion.piso;
    this.direccion.telefono = direccion.telefono;
    this.direccion.movil = direccion.movil;
    this.direccion.estado_direccion = direccion.estado_direccion;
    this.direccion.id_ciudad = direccion.id_ciudad;
    this.edit = true;
    this.open(this.modal);
  }
  public borrarDireccion(id_direcion: number) {
    this.direccionesservice.deleteDireccion(id_direcion).subscribe((res: any) => {
      this.modalDireccion.dismissAll();
      this.getDireciones();
      this.limpiar();
    })
  }
  public saveDireccion() {
    (this.edit ? this.updateDireccion() : this.storeDireccion());
  }
  public updateDireccion() {
    this.direccionesservice.updateDireccion(this.direccion).subscribe((res: any) => {
      this.modalDireccion.dismissAll();
      this.getDireciones();
      this.limpiar();
      Swal.fire({
        title:'Dirección',
        text:'Dirección Creada Exitosamente',
        icon:'success'
      });
    })

  }
  public storeDireccion() {
    this.direccionesservice.saveDireccion(this.direccion).subscribe((res: any) => {
      this.modalDireccion.dismissAll();
      this.getDireciones();
      this.limpiar();
      Swal.fire({
        title:'Dirección',
        text:'Dirección Creada Exitosamente',
        icon:'success'
      });
    })
  }
  private limpiar() {
    this.direccion.id_direccion =0;
    this.direccion.direcion = '';
    this.direccion.calle = '';
    this.direccion.numero = '';
    this.direccion.piso = '';
    this.direccion.telefono = '';
    this.direccion.movil = '';
    this.direccion.estado_direccion = '';
    this.direccion.id_ciudad = 0;
  }

}
