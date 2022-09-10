import { IPedido } from './../../../modules/home/product-detail/pedido.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class PedidoService {
  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallPedido() {
    return this.http.get(`${this.API_URI}pedido`);
  }
  savePedido(newPedido: IPedido){
    return this.http.post(`${this.API_URI}pedido`,newPedido);
  }
  enviarPedido(id_pedido:number){
    return this.http.put(`${this.API_URI}pedido/enviar/${id_pedido}`,null);
  }
  pagarPedido(id_pedido:number){
    return this.http.put(`${this.API_URI}pedido/pagar/${id_pedido}`,null);
  }
}
