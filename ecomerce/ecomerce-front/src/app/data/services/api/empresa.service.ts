import { IEmpresa } from './../../../modules/config/empresa/empresa.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class EmpresaService {
  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallEmpresas(){
    return this.http.get(`${this.API_URI}empresas`);
  }
  saveEmpresa(newEmpresa: IEmpresa){
    return this.http.post(`${this.API_URI}empresas`,newEmpresa);
  }
  updateEmpresa(newEmpresa: IEmpresa){
    return this.http.put(`${this.API_URI}empresas/${newEmpresa.id_empresa}`,newEmpresa);
  }
  deleteEmpresa(id_empresa:number){
    return this.http.delete(`${this.API_URI}empresas/${id_empresa}`);
  }
}
