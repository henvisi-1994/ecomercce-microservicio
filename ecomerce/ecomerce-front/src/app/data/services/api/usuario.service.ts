import { IUser } from './../../../modules/user/user/user.metadata';
import { environment } from './../../../../environments/environment.prod';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class UsuarioService {
  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  getallUsuarios(){
    return this.http.get(`${this.API_URI}usuario`);
  }
  saveUsuario(newUsuario: IUser){
    return this.http.post(`${this.API_URI}usuario`,newUsuario);
  }
  updateUsuario(newUsuario: IUser){
    return this.http.put(`${this.API_URI}usuario/${newUsuario.id}`,newUsuario);
  }
  deleteUsuario(id:number){
    return this.http.delete(`${this.API_URI}usuario/${id}`);
  }
}
