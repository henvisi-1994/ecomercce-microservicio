import { ICargo } from './../../../modules/config/cargo/cargo.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CargoService {

  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallCargos(){
    return this.http.get(`${this.API_URI}cargos`);
  }
  saveCargo(newCargo: ICargo){
    return this.http.post(`${this.API_URI}cargos`,newCargo);
  }
  updateCargo(newCargo: ICargo){
    return this.http.put(`${this.API_URI}cargos/${newCargo.id_cargo}`,newCargo);
  }
  deleteCargo(id_cargo:number){
    return this.http.delete(`${this.API_URI}cargos/${id_cargo}`);
  }
}
