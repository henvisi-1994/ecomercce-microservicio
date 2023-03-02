import { TipoIdentificacionService } from './../../../data/services/api/tipo-identificacion.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { ITipoIdentificacion } from './tipoIdentificacion.metadata';
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import Swal from 'sweetalert2';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-tipo-identificacion',
  templateUrl: './tipo-identificacion.component.html',
  styleUrls: ['./tipo-identificacion.component.css']
})
export class TipoIdentificacionComponent implements OnInit {
  closeResult: string | undefined;
  public tipoIdentificacionForm: FormGroup;
  tiposIdentificacion:any = []
  @ViewChild('tipoIdentificacionModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalTipoIdentificacion: NgbModal,private tipoidentificacionservice:TipoIdentificacionService,private formBuilder: FormBuilder) {
    this.tipoIdentificacionForm = this.formBuilder.group({
      id_tipo_ident: [''],
      nombre_tipo_ident: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      estado_tipo_ident: ['', Validators.required, Validators.minLength(1), Validators.maxLength(1)]
    });
   }

  ngOnInit(): void {
    this.getTipoIdentificaciones();
  }
  getTipoIdentificaciones() {
    this.tipoidentificacionservice.getallTipoIdentificaciones().subscribe(tiposIdentificacion => this.tiposIdentificacion = tiposIdentificacion);
  }
  // Boton para abrir ventana modal
  open(content: any) {
    this.modalTipoIdentificacion.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
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
  public editTipoIdentificacion(tipoIdentificacion: any) {
    this.tipoIdentificacionForm.setValue({id_tipo_ident :tipoIdentificacion.id_tipo_ident,
    nombre_tipo_ident : tipoIdentificacion.nombre_tipo_ident,
    estado_tipo_ident : tipoIdentificacion.estado_tipo_ident});
    this.edit = true;
    this.open(this.modal);
  }
  get f(){
    return this.tipoIdentificacionForm.controls;
  }
  public borrarTipoIdentificacion(id_tipo_ident: number) {
    this.tipoidentificacionservice.deleteTipoIdentificacion(id_tipo_ident).subscribe((res: any) => {
      this.modalTipoIdentificacion.dismissAll();
      this.getTipoIdentificaciones();
      this.limpiar();
    })
  }
  public saveTipoIdentificacion() {
    (this.edit ? this.updateTipoIdentificacion() : this.storeTipoIdentificacion());
  }
  public updateTipoIdentificacion() {
    this.tipoidentificacionservice.updateTipoIdentificacion(this.tipoIdentificacionForm.value).subscribe((res: any) => {
      this.modalTipoIdentificacion.dismissAll();
      this.getTipoIdentificaciones();
      this.limpiar();
      Swal.fire({
        title:'Tipo de Identificación',
        text:'Tipo de Identificación Actualizado Exitosamente',
        icon:'success'
      });
    })

  }
  public storeTipoIdentificacion() {
    this.tipoidentificacionservice.saveTipoIdentificacion(this.tipoIdentificacionForm.value).subscribe((res: any) => {
      this.modalTipoIdentificacion.dismissAll();
      this.getTipoIdentificaciones();
      this.limpiar();
      Swal.fire({
        title:'Tipo de Identificación',
        text:'Tipo de Identificación Creado Exitosamente',
        icon:'success'
      });
    })
  }
  private limpiar() {
    this.tipoIdentificacionForm.reset();
  }
}
