import { CiudadService } from './../../../../data/services/api/ciudad.service';
import { DireccionService } from './../../../../data/services/api/direccion.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { IDireccion } from './direccion.metadata';
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import Swal from 'sweetalert2';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-direccion',
  templateUrl: './direccion.component.html',
  styleUrls: ['./direccion.component.css']
})
export class DireccionComponent implements OnInit {
  closeResult: string | undefined;
  public direccionForm: FormGroup;
  direcciones: any = [];
  ciudades: any = [];
  @ViewChild('direccionModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalDireccion: NgbModal, private direccionesservice: DireccionService, private ciudadservice: CiudadService, private formBuilder: FormBuilder) {
    this.direccionForm = this.formBuilder.group({
      id_direccion: [''],
      direcion: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      calle: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      numero: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      piso: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      telefono: ['', Validators.required, Validators.minLength(10), Validators.maxLength(15)],
      movil: ['', Validators.required, Validators.minLength(10), Validators.maxLength(15)],
      estado_direccion: ['', Validators.required, Validators.minLength(1), Validators.maxLength(1)],
      id_ciudad: ['', Validators.required]
    });
  }

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
    this.direccionForm.setValue({
      id_direccion: direccion.id_direccion,
      direcion: direccion.direcion,
      calle: direccion.calle,
      numero: direccion.numero,
      piso: direccion.piso,
      telefono: direccion.telefono,
      movil: direccion.movil,
      estado_direccion: direccion.estado_direccion,
      id_ciudad: direccion.id_ciudad
    });
    this.edit = true;
    this.open(this.modal);
  }
  get f(){
    return this.direccionForm.controls;
  }
  public borrarDireccion(id_direcion: number) {
    this.direccionesservice.deleteDireccion(id_direcion).subscribe((res: any) => {
      this.modalDireccion.dismissAll();
      this.getDireciones();
      this.limpiar();
    })
  }
  public saveDireccion() {
    if (!this.direccionForm.valid) {
      return;
    }
    else {
      (this.edit ? this.updateDireccion() : this.storeDireccion());
    }
  }
  public updateDireccion() {
    this.direccionesservice.updateDireccion(this.direccionForm.value).subscribe((res: any) => {
      this.modalDireccion.dismissAll();
      this.getDireciones();
      this.limpiar();
      Swal.fire({
        title: 'Dirección',
        text: 'Dirección Creada Exitosamente',
        icon: 'success'
      });
    })

  }
  public storeDireccion() {
    this.direccionesservice.saveDireccion(this.direccionForm.value).subscribe((res: any) => {
      this.modalDireccion.dismissAll();
      this.getDireciones();
      this.limpiar();
      Swal.fire({
        title: 'Dirección',
        text: 'Dirección Creada Exitosamente',
        icon: 'success'
      });
    })
  }
  private limpiar() {
    this.direccionForm.reset();
  }

}
