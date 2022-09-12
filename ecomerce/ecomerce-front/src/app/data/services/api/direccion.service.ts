import { IDireccion } from './../../../modules/config/ubicacion/direccion/direccion.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class DireccionService {

  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallDirecciones(){
    return this.http.get(`${this.API_URI}direccion`);
  }
  saveDireccion(newDireccion: IDireccion){
    return this.http.post(`${this.API_URI}direccion`,newDireccion);
  }
  updateDireccion(newDireccion: IDireccion){
    return this.http.put(`${this.API_URI}direccion/${newDireccion.id_direccion}`,newDireccion);
  }
  deleteDireccion(id_direccion:number){
    return this.http.delete(`${this.API_URI}direccion/${id_direccion}`);
  }
}
