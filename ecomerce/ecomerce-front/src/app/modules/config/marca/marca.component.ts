import { MarcaService } from '../../../data/services/api/marca.service';
import { IMarca } from './marca.metadata';
import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import Swal from 'sweetalert2';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-marca',
  templateUrl: './marca.component.html',
  styleUrls: ['./marca.component.css']
})
export class MarcaComponent implements OnInit {
  closeResult: string | undefined;
  marcas: any = [];
  @ViewChild('marcaModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  public marcaForm: FormGroup;
  constructor(private modalMarca: NgbModal, private marcaservice: MarcaService,private formBuilder: FormBuilder) {
    this.marcaForm = this.formBuilder.group({
      id_marca: [''],
      nomb_marca: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      observ_marca: ['',  Validators.minLength(1), Validators.maxLength(255)],
      estado_marca: ['', Validators.required, Validators.minLength(1), Validators.maxLength(1)],
    });
  }

  ngOnInit(): void {
    this.geMarcas();
  }
  geMarcas() {
    this.marcaservice.getallMarcas().subscribe(marcas => this.marcas = marcas);
  }

  // Boton para abrir ventana modal
  open(content: any) {
    this.modalMarca.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
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
  public editMarca(marca: any) {
    this.marcaForm.setValue({id_marca : marca.id_marca,
    nomb_marca : marca.nomb_marca,
    observ_marca : marca.observ_marca,
     estado_marca : marca.estado_marca});
    this.edit = true;
    this.open(this.modal);
  }
  public borrarMarca(id_marca: number) {
    this.marcaservice.deleteMarca(id_marca).subscribe((res: any) => {
      this.modalMarca.dismissAll();
      this.geMarcas();
      this.limpiar();
    })
  }
  get f(){
    return this.marcaForm.controls;
  }
  public saveMarca() {
    if (!this.marcaForm.valid) {
      return;
    }
    else {
      (this.edit ? this.updateMarca() : this.storeMarca());
    }
  }
  public updateMarca() {
    this.marcaservice.updateMarca(this.marcaForm.value).subscribe((res: any) => {
      Swal.fire({
        title:'Marca',
        text:'Marca Actualizada Exitosamente',
        icon:'success'
      });
      this.modalMarca.dismissAll();
      this.geMarcas();
      this.limpiar();
    })

  }
  public storeMarca() {
    this.marcaservice.saveMarca(this.marcaForm.value).subscribe((res: any) => {
      Swal.fire({
        title:'Marca',
        text:'Marca Creada Exitosamente',
        icon:'success'
      });
      this.modalMarca.dismissAll();
      this.geMarcas();
      this.limpiar();
    })
  }
  private limpiar() {
    this.marcaForm.reset();
  }
}
