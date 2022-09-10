import { CategoriaService } from './../../../data/services/api/categoria.service';
import { ICategoria } from './categoria.metadata';
import { Component, ElementRef, OnInit, ViewChild } from '@angular/core';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-categoria',
  templateUrl: './categoria.component.html',
  styleUrls: ['./categoria.component.css']
})
export class CategoriaComponent implements OnInit {
  closeResult: string | undefined;
  categoria: ICategoria = {
    id_cat: 0,
    nomb_cat: '',
    observ_cat: '',
    estado_cat: 'I'
  }
  categorias:any = [];
  @ViewChild('categoriaModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalCategoria: NgbModal,private categoriasaservice:CategoriaService) { }

  ngOnInit(): void {
    this.getCategorias();
  }
  getCategorias(){
    this.categoriasaservice.getallCategorias().subscribe(categorias=> this.categorias=categorias);
  }
  // Boton para abrir ventana modal
  open(content: any) {
    this.modalCategoria.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
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
  public editCategoria(categoria: any) {
    this.categoria.id_cat = categoria.id_cat;
    this.categoria.nomb_cat = categoria.nomb_cat;
    this.categoria.observ_cat = categoria.observ_cat,
      this.categoria.estado_cat = categoria.estado_cat;
    this.edit = true;
    this.open(this.modal);
  }
  public borrarCategoria(id_cat: number) {
    this.categoriasaservice.deleteCategoria(id_cat).subscribe((res: any) => {
      this.modalCategoria.dismissAll();
      this.getCategorias();
      this.limpiar();
    })
  }
  public saveCategoria() {
    (this.edit ? this.updateCategoria() : this.storeCategoria());
  }
  public updateCategoria() {
    this.categoriasaservice.updateCategoria(this.categoria).subscribe((res: any) => {
      this.modalCategoria.dismissAll();
      this.getCategorias();
      this.limpiar();
      Swal.fire({
        title:'Categoria',
        text:'Categoria Actualizada Exitosamente',
        icon:'success'
      });
    })

  }
  public storeCategoria() {
    this.categoriasaservice.saveCategoria(this.categoria).subscribe((res: any) => {
      this.modalCategoria.dismissAll();
      this.getCategorias();
      this.limpiar();
      Swal.fire({
        title:'Categoria',
        text:'Categoria Creada Exitosamente',
        icon:'success'
      });
    })
  }
  private limpiar(){
    this.categoria.id_cat = 0;
    this.categoria.nomb_cat = "";
    this.categoria.observ_cat = "",
      this.categoria.estado_cat = "";
  }
}
