import { ICiudad } from './../../../modules/config/ubicacion/ciudad/ciudad.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CiudadService {

  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallCiudades(){
    return this.http.get(`${this.API_URI}ciudad`);
  }
  saveCiudad(newCiudad: ICiudad){
    return this.http.post(`${this.API_URI}ciudad`,newCiudad);
  }
  updateCiudad(newCiudad: ICiudad){
    return this.http.put(`${this.API_URI}ciudad/${newCiudad.id_ciudad}`,newCiudad);
  }
  deleteCiudad(id_ciudad:number){
    return this.http.delete(`${this.API_URI}ciudad/${id_ciudad}`);
  }
}
