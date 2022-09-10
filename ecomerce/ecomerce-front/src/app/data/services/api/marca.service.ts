import { IMarca } from './../../../modules/config/marca/marca.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class MarcaService {
  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallMarcas(){
    return this.http.get(`${this.API_URI}marcas`);
  }
  saveMarca(newMarca: IMarca){
    return this.http.post(`${this.API_URI}marcas`,newMarca);
  }
  updateMarca(newMarca: IMarca){
    return this.http.put(`${this.API_URI}marcas/${newMarca.id_marca}`,newMarca);
  }
  deleteMarca(id_marca:number){
    return this.http.delete(`${this.API_URI}marcas/${id_marca}`);
  }
}
