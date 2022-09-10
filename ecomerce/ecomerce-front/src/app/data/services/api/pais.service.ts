import { IPais } from './../../../modules/config/ubicacion/pais/pais.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class PaisService {

  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallPaises(){
    return this.http.get(`${this.API_URI}pais`);
  }
  savePais(newPais: IPais){
    return this.http.post(`${this.API_URI}pais`,newPais);
  }
  updatePais(newPais: IPais){
    return this.http.put(`${this.API_URI}pais/${newPais.id_pais}`,newPais);
  }
  deletePais(id_pais:number){
    return this.http.delete(`${this.API_URI}pais/${id_pais}`);
  }
}
