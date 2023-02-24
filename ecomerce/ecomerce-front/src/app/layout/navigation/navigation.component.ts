import { CategoriaService } from './../../data/services/api/categoria.service';
import { AuthService } from './../../data/services/api/auth.service';
import { Component, OnInit } from '@angular/core';
import { ProductoService } from '@data/services/api/producto.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navigation',
  templateUrl: './navigation.component.html',
  styleUrls: ['./navigation.component.css']
})
export class NavigationComponent implements OnInit {

  constructor(private authService: AuthService,
    private categoriasaservice: CategoriaService,
    private productService:ProductoService,
     private router: Router) { }
  isAuth = false;
  isempleado: boolean = false;
  categorias: any = [];
  productos:any=[];
  search:string ='';
  ngOnInit(): void {
    this.isAuth = this.authService.estaLogeado();
    if ((this.authService.tipoUser()) == 'Empleado') {
      this.isempleado = true;
    }
    this.getCategorias()
    this.getProductos()
  }
  public getProductos(){
    this.productService.getActivoProductos().subscribe(r=>{this.productos= r; })
  }
  getCategorias() {
    this.categoriasaservice.getTopCategoria().subscribe(categorias => this.categorias = categorias);
  }
  logout() {
    localStorage.clear();
    this.isAuth = false;
    window.location.reload();
  }
   pulsar(e:any) {
    if (e.keyCode === 13 && !e.shiftKey) {
        e.preventDefault();
        let ruta = "/busqueda/"+this.search;
        this.router.navigate([ruta]);

    }
}
}
