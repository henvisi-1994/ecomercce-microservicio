import { ActivatedRoute } from '@angular/router';
import { ProductoService } from './../../../data/services/api/producto.service';
import { Component, OnInit } from '@angular/core';
import { CategoriaService } from '@data/services/api/categoria.service';

@Component({
  selector: 'app-producto-categoria',
  templateUrl: './producto-categoria.component.html',
  styleUrls: ['./producto-categoria.component.css']
})
export class ProductoCategoriaComponent implements OnInit {
productos:any=[];
categorias:any=[];
  iscategoria: boolean=false;
  constructor(
    private productService: ProductoService,
    private categoriasaservice:CategoriaService,
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    this.getCategorias();

    this.route.paramMap.subscribe(params => {
      let id_cat =   params.get("id");
      if (params.has('id')) {
        if (id_cat !== 'otras') {
          this.iscategoria= false;
          this.productService.getProductoCategoria(params.get("id")).subscribe(productos => this.productos = productos);
        } else {
          this.getProductos();
          this.iscategoria= true;
        }
      }

    })
  }
  public getProductos() {
    this.productService.gettopProductos().subscribe(r => { this.productos = r; })
  }
  getCategorias() {
    this.categoriasaservice.getActivaCategorias().subscribe(categorias => this.categorias = categorias);
  }

}
