import { IDetallePedido } from './../../../modules/home/product-detail/detalle-pedido.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class DetallePedidoService {

  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  saveDetalle(newDetallePedido: IDetallePedido){
    return this.http.post(`${this.API_URI}pedido/detalle`,newDetallePedido);
  }
  getCart(id_cliente:any){
    return this.http.get(`${this.API_URI}pedido/detalle/${id_cliente}`);
  }
  getDetalle(id_pedido:number){
    return this.http.get(`${this.API_URI}pedido/detalle/admin/${id_pedido}`);
  }
  deleteDetalle(id_detalle_ped:number){
    return this.http.delete(`${this.API_URI}pedido/detalle/${id_detalle_ped}`);
  }
}
