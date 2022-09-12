import { DetallePedidoService } from './../../../data/services/api/detalle-pedido.service';
import { Component, OnInit } from '@angular/core';
import { PedidoService } from '@data/services/api/pedido.service';

@Component({
  selector: 'app-car-shop',
  templateUrl: './car-shop.component.html',
  styleUrls: ['./car-shop.component.css']
})
export class CarShopComponent implements OnInit {
  subtotal: any;
  IVA:any;
  total: any;

  constructor(private detallepedidoservice: DetallePedidoService,private pedidoservices: PedidoService) { }
  productos: any = [];
  ngOnInit(): void {
    let id_cliente = localStorage.getItem('id_cliente');
    this.detallepedidoservice.getCart(id_cliente).subscribe(productos =>{
      this.productos = productos
      this.subtotal= this.productos.map((item: { total_detalle: any; }) => item.total_detalle).reduce((prev: any, curr: any) => prev + curr, 0)/1.12;
      this.IVA= this.subtotal*0.12;
      this.total= this.subtotal+this.IVA;
    });


  }
  deleteDetalle(id_detalle_ped: number) {
    let id_cliente = localStorage.getItem('id_cliente');
    this.detallepedidoservice.deleteDetalle(id_detalle_ped).subscribe(res => {
      this.detallepedidoservice.getCart(id_cliente).subscribe(productos => this.productos = productos);
      this.getpedidos();
    })
  }
  pagarPedido(id_pedido: number) {
    this.pedidoservices.pagarPedido(id_pedido).subscribe((res: any) => {
      alert('Gracias por compar en StoreEP')
      this.getpedidos();
    })
  }
  getpedidos(){
    let id_cliente = localStorage.getItem('id_cliente');
    this.detallepedidoservice.getCart(id_cliente).subscribe(productos =>{
      this.productos = productos
      this.subtotal= this.productos.map((item: { total_detalle: any; }) => item.total_detalle).reduce((prev: any, curr: any) => prev + curr, 0)/1.12;
      this.IVA= this.subtotal*0.12;
      this.total= this.subtotal+this.IVA;
    });
  }

}
