import { IUserRegister } from './../../../modules/auth/register/userRegister.metadata';
import { IUser } from './../../../modules/user/user/user.metadata';
import { environment } from './../../../../environments/environment.prod';
import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  API_URI = environment.uri; // URL de Backend
  constructor(private http: HttpClient) { }
  register(newUser: IUserRegister){
    return this.http.post(`${this.API_URI}register`,newUser);
  }
  login(newUser: IUser){
    return this.http.post(`${this.API_URI}login`,newUser);
  }
  estaLogeado(): boolean {
    return !!localStorage.getItem('token');
  }
  tipoUser(): string{
    if (localStorage.getItem('id_cliente') != undefined) {
      return 'Cliente'
    } else if(localStorage.getItem('id_empleado') != undefined){
      return 'Empleado'
    }else{
      return ''
    }
  }
  getToken() {
    return localStorage.getItem('token');
  }
}
