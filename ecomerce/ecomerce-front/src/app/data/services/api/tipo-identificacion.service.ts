import { ITipoIdentificacion } from './../../../modules/config/tipo-identificacion/tipoIdentificacion.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class TipoIdentificacionService {
  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallTipoIdentificaciones(){
    return this.http.get(`${this.API_URI}tipoIdent`);
  }
  saveTipoIdentificacion(newTipoIdentificacion: ITipoIdentificacion){
    return this.http.post(`${this.API_URI}tipoIdent`,newTipoIdentificacion);
  }
  updateTipoIdentificacion(newTipoIdentificacion: ITipoIdentificacion){
    return this.http.put(`${this.API_URI}tipoIdent/${newTipoIdentificacion.id_tipo_ident}`,newTipoIdentificacion);
  }
  deleteTipoIdentificacion(id_tipo_ident:number){
    return this.http.delete(`${this.API_URI}tipoIdent/${id_tipo_ident}`);
  }
}
