import { ICategoria } from './../../../modules/config/categoria/categoria.metadata';
import { HttpClient } from '@angular/common/http';
import { environment } from './../../../../environments/environment.prod';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class CategoriaService {
  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallCategorias(){
    return this.http.get(`${this.API_URI}categorias`);
  }
  getActivaCategorias(){
    return this.http.get(`${this.API_URI}categorias/activa`);
  }
  getTopCategoria(){
    return this.http.get(`${this.API_URI}categorias/top`);
  }
  saveCategoria(newCategoria: ICategoria){
    return this.http.post(`${this.API_URI}categorias`,newCategoria);
  }
  updateCategoria(newCategoria: ICategoria){
    return this.http.put(`${this.API_URI}categorias/${newCategoria.id_cat}`,newCategoria);
  }
  deleteCategoria(id_cat:number){
    return this.http.delete(`${this.API_URI}categorias/${id_cat}`);
  }
}
