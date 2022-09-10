import { ProductoService } from './../../../data/services/api/producto.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  productos:any = [ ]
  constructor(private productService: ProductoService) { }

  ngOnInit(): void {
    this.getProductos();
  }
  public getProductos(){
    this.productService.getActivoProductos().subscribe(r=>{this.productos= r; })
  }

}
