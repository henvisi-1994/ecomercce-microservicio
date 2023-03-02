import { ProductoService } from './../../../data/services/api/producto.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { IProducto } from './producto.metadata'
import { Component, OnInit, ElementRef, ViewChild } from '@angular/core'
import { BodegaService } from '@data/services/api/bodega.service';
import { CategoriaService } from '@data/services/api/categoria.service';
import { EmpresaService } from '@data/services/api/empresa.service';
import { MarcaService } from '@data/services/api/marca.service';
import Swal from 'sweetalert2';
import { environment } from 'environments/environment.prod';

@Component({
  selector: 'app-producto',
  templateUrl: './producto.component.html',
  styleUrls: ['./producto.component.css'],
})
export class ProductoComponent implements OnInit {
  closeResult: string | undefined
  file: any;
  public productoForm: FormGroup;
  image: any = '../../../../../assets/images/upload.png';
  productos: any = [];

  bodegas:any = [];
  marcas:any = [  ]
  categorias:any = [ ]
  empresas:any = [ ]
  @ViewChild('productoModal', { static: false }) modal: ElementRef | undefined
  edit = false
  constructor(private modalProducto: NgbModal, private productService: ProductoService,private bodegaservice:BodegaService,private categoriasaservice:CategoriaService,private empresaservice:EmpresaService, private marcaservice:MarcaService,private formBuilder: FormBuilder ){
    this.productoForm = this.formBuilder.group({
      id_prod: [''],
      codigo_prod: ['', Validators.required, Validators.minLength(3), Validators.maxLength(255)  ],
      codbarra_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      descripcion_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      present_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      precio_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      stockmin_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      stockmax_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      stock_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      fechaing_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      fechaelab_prod: [''],
      fechacad_prod: [''],
      aplicaiva_prod: ['', Validators.required,Validators.minLength(1), Validators.maxLength(1)],
      aplicaice_prod: ['',Validators.minLength(1), Validators.maxLength(1)],
      util_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      comision_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      observ_prod: ['', Validators.required,Validators.minLength(3), Validators.maxLength(255)],
      estado_prod: ['', Validators.required,Validators.minLength(1), Validators.maxLength(1)],
      id_marca: ['', Validators.required],
      id_cat: ['', Validators.required],
    });
   }

  ngOnInit(): void {
    this.getProductos();
    this.getBodegas();
    this.getCategorias();
    this.getEmpresas();
    this.getMarcas();
  }
  getBodegas(){
    this.bodegaservice.getallBodegas().subscribe(bodegas=> this.bodegas=bodegas);
  }
  getCategorias(){
    this.categoriasaservice.getallCategorias().subscribe(categorias=> this.categorias=categorias);
  }
  getEmpresas(){
    this.empresaservice.getallEmpresas().subscribe(empresas=> this.empresas=empresas);
  }
  getMarcas() {
    this.marcaservice.getallMarcas().subscribe(marcas => this.marcas = marcas);
  }
  public onFileChange(event: any) {
    if (event.target.files && event.target.files.length > 0) {
      const file = event.target.files[0];
      if (file.type.includes('image')) {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
          this.image = reader.result;
        }
        this.file = file;
      } else {
        console.log('ha ocurrido un error');
      }
    }
  }
  // Boton para abrir ventana modal
  open(content: any) {
    this.modalProducto
      .open(content, { ariaLabelledBy: 'modal-basic-title' })
      .result.then(
        (result) => {
          this.closeResult = `Closed with: ${result}`
        },
        (reason) => {
          this.closeResult = `Dismissed ${this.getDismissReason(reason)}`
        },
      )
  }
  // Cierra Ventana modal
  private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC'
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop'
    } else {
      return `with: ${reason}`
    }
  }
  get f(){
    return this.productoForm.controls;
  }
  public editProducto(producto: any) {
    this.productoForm.setValue({id_prod : producto.id_prod,
      codigo_prod : producto.codigo_prod,
      estado_prod : producto.estado_prod,
      codbarra_prod : producto.codbarra_prod,
      descripcion_prod : producto.descripcion_prod,
      present_prod : producto.present_prod,
      precio_prod : producto.precio_prod,
      stockmin_prod :producto.stockmin_prod,
      stockmax_prod : producto.stockmax_prod,
      stock_prod : producto.stock_prod,
      fechaing_prod : producto.fechaing_prod,
      fechaelab_prod : producto.fechaelab_prod,
      fechacad_prod : producto.fechacad_prod,
      aplicaiva_prod : producto.aplicaiva_prod,
      aplicaice_prod : producto.aplicaice_prod,
      util_prod : producto.util_prod,
      comision_prod : producto.comision_prod,
      observ_prod : producto.observ_prod,
      id_marca : producto.id_marca,
      id_cat : producto.id_cat});
      this.edit = true
    this.open(this.modal)
  }
  public getProductos() {
    this.productService.getallProductos().subscribe(r => { this.productos = r; })
  }
  public borrarProducto(id_prod: number) {
    this.productService.deleteProducto(id_prod).subscribe((res: any) => {
      this.modalProducto.dismissAll();
      this.getProductos();
      this.limpiar();
    })
  }
  public saveProducto() {
    if(!this.productoForm.valid){
      return;
    }
    else{
      (this.edit ? this.updateProducto() : this.storeProducto());
    }
  }
  public updateProducto() {
    this.productoForm.controls['aplicaiva_prod'].setValue( this.convertir(this.productoForm.controls['aplicaiva_prod'].value));
    this.productoForm.controls['aplicaice_prod'].setValue(this.convertir(this.productoForm.controls['aplicaice_prod'].value));
    this.productService.updateProducto(this.productoForm.value, this.file).subscribe((res: any) => {
      this.modalProducto.dismissAll();
      this.getProductos();
      this.limpiar();
      Swal.fire({
        title:'Producto',
        text:'Producto Actualizado Exitosamente',
        icon:'success'
      });
    })
  }
  public storeProducto() {
    this.productoForm.controls['aplicaiva_prod'].setValue( this.convertir(this.productoForm.controls['aplicaiva_prod'].value));
    this.productoForm.controls['aplicaice_prod'].setValue(this.convertir(this.productoForm.controls['aplicaice_prod'].value));
    this.productService.saveProducto(this.productoForm.value, this.file).subscribe((res: any) => {
      this.modalProducto.dismissAll();
      this.getProductos();
      this.limpiar();
      Swal.fire({
        title:'Producto',
        text:'Producto Creado Exitosamente',
        icon:'success'
      });
    })
  }
  convertir(value: string) {
    if (value) {
      return '1';
    } else {
      return '0';
    }
  }
  private limpiar() {
    this.edit = false
    this.productoForm.reset();
  }
}
