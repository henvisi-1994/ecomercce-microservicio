import { IProvincia } from './../../../modules/config/ubicacion/provincia/provincia.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ProvinciaService {

  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallProvinciaes(){
    return this.http.get(`${this.API_URI}provincia`);
  }
  saveProvincia(newProvincia: IProvincia){
    return this.http.post(`${this.API_URI}provincia`,newProvincia);
  }
  updateProvincia(newProvincia: IProvincia){
    return this.http.put(`${this.API_URI}provincia/${newProvincia.id_provincia}`,newProvincia);
  }
  deleteProvincia(id_provincia:number){
    return this.http.delete(`${this.API_URI}provincia/${id_provincia}`);
  }
}
