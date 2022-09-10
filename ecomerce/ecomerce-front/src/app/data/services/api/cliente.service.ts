import { ICliente } from './../../../modules/config/clientes/cliente.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ClienteService {
  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallClientes(){
    return this.http.get(`${this.API_URI}cliente`);
  }
  saveClñiente(newCliente: ICliente){
    return this.http.post(`${this.API_URI}cliente`,newCliente);
  }

  updateCliente(newCliente: ICliente){
    return this.http.put(`${this.API_URI}cliente/${newCliente.id_cliente}`,newCliente);
  }
  deleteCliente(id_cliente:number){
    return this.http.delete(`${this.API_URI}cliente/${id_cliente}`);
  }
}
