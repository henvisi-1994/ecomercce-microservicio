import { PaisService } from './../../../../data/services/api/pais.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { IPais } from './pais.metadata';
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import Swal from 'sweetalert2';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-pais',
  templateUrl: './pais.component.html',
  styleUrls: ['./pais.component.css']
})
export class PaisComponent implements OnInit {
  closeResult: string | undefined;
  public paisForm: FormGroup;
  paises: any = [];
  @ViewChild('paisModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalPais: NgbModal, private paisservice: PaisService, private formBuilder: FormBuilder) {
    this.paisForm = this.formBuilder.group({
      id_pais: [''],
      nombre_pais: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      estado_pais: ['', Validators.required, Validators.minLength(1), Validators.maxLength(1)]
    });
  }

  ngOnInit(): void {
    this.getPaises();
  }
  // Boton para abrir ventana modal
  open(content: any) {
    this.modalPais.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
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
  public getPaises() {
    this.paisservice.getallPaises().subscribe(paises => this.paises = paises);
  }

  public editPais(pais: any) {
    this.paisForm.setValue({
      id_pais: pais.id_pais,
      nombre_pais: pais.nombre_pais,
      estado_pais: pais.estado_pais
    });
    this.edit = true;
    this.open(this.modal);
  }
  public borrarPais(id_pais: number) {
    this.paisservice.deletePais(id_pais).subscribe((res: any) => {
      this.modalPais.dismissAll();
      this.getPaises();
      this.limpiar();
    })
  }
  public savePais() {
    if (!this.paisForm.valid) {
      return;
    }
    else {
      (this.edit ? this.updatePais() : this.storePais());
    }
  }
  public updatePais() {
    this.paisservice.updatePais(this.paisForm.value).subscribe((res: any) => {
      this.modalPais.dismissAll();
      this.getPaises();
      this.limpiar();
      Swal.fire({
        title: 'Pais',
        text: 'Pais Actualizado Exitosamente',
        icon: 'success'
      });
    })

  }
  public storePais() {
    this.paisservice.savePais(this.paisForm.value).subscribe((res: any) => {
      this.modalPais.dismissAll();
      this.getPaises();
      this.limpiar();
      Swal.fire({
        title: 'Pais',
        text: 'Pais Creado Exitosamente',
        icon: 'success'
      });
    })
  }
  private limpiar() {
    this.paisForm.reset();
  }
  get f(){
    return this.paisForm.controls;
  }

}
