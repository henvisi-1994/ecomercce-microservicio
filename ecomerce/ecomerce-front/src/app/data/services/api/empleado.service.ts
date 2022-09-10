import { IEmpleado } from './../../../modules/config/empleados/empleado.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class EmpleadoService {

  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallEmpleadoes(){
    return this.http.get(`${this.API_URI}empleado`);
  }
  saveEmpleado(newEmpleado: IEmpleado){
    return this.http.post(`${this.API_URI}empleado`,newEmpleado);
  }
  updateEmpleado(newEmpleado: IEmpleado){
    return this.http.put(`${this.API_URI}empleado/${newEmpleado.id_empleado}`,newEmpleado);
  }
  deleteEmpleado(id_empleado:number){
    return this.http.delete(`${this.API_URI}empleado/${id_empleado}`);
  }
}
