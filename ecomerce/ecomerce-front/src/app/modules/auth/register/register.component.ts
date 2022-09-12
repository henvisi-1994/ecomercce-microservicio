import { environment } from './../../../../environments/environment.prod';
import { ProvinciaService } from './../../../data/services/api/provincia.service';
import { PaisService } from './../../../data/services/api/pais.service';
import { Router } from '@angular/router';
import { TipoIdentificacionService } from './../../../data/services/api/tipo-identificacion.service';
import { PersonaService } from './../../../data/services/api/persona.service';
import { DireccionService } from './../../../data/services/api/direccion.service';
import { EmpresaService } from './../../../data/services/api/empresa.service';
import { IPersona } from './../../../data/interfaces/persona.metadata';
import { IUserRegister } from './userRegister.metadata';
import { Component, OnInit } from '@angular/core';
import { AuthService } from '@data/services/api/auth.service';
import { CiudadService } from '@data/services/api/ciudad.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  user:IUserRegister={
    id: 0,
    email: '',
    password: '',
    tipo_cli: 'Cliente Online',
    fecha_inicio: '',
    fecha_fin: '',
    estado_cli: '',
    id_persona: 0,
    id_empresa: environment.id_empresa,
    direcion: '',
    calle: '',
    numero: '',
    piso: '',
    telefono: '',
    movil: '',
    id_ciudad: 0
  }
  persona:IPersona={
    id_persona:0,
    nombre_persona:'',
    apellido_persona:'',
    dni:'',
    id_tipo_ident	:0
  }
  id_pais:number=0;
  id_provincia:number=0;
  id_ciudad:number=0;

  empresas:any = [];
  direcciones:any=[];
  tiposIdentificacion:any=[];
  paises:any=[];
  ciudades:any=[];
  ciudades_data:any=[];
  provincias:any=[];
  provincias_data:any=[];
  constructor(private authService:AuthService,
    private empresaservice:EmpresaService,
    private direccionesservice: DireccionService,
    private personaservice:PersonaService,
    private tipoidentificacionservice:TipoIdentificacionService,
    private paisservice:PaisService,
    private provinciaservice:ProvinciaService,
    private ciudadservice:CiudadService,
    private router: Router) { }

  ngOnInit(): void {
    this.getDireciones();
    this.getEmpresas();
    this.getTipoIdentificaciones();
    this.getPaises();
    this.getProvincias();
    this.getCiudades();
  }
  getTipoIdentificaciones() {
    this.tipoidentificacionservice.getallTipoIdentificaciones().subscribe(tiposIdentificacion => this.tiposIdentificacion = tiposIdentificacion);
  }
  getEmpresas(){
    this.empresaservice.getallEmpresas().subscribe(empresas=> this.empresas=empresas);
  }
  onChangePais(event:any){
   let id_pais=event.value
    let result = this.provincias_data.filter((provincia: string | any)=> {
      return provincia.id_pais  == id_pais;
    });
    this.provincias= result;
  }
  onChangeProvincia(event:any){
    let id_provincia=event.value
     let result = this.ciudades_data.filter((ciudad: string | any)=> {
       return ciudad.id_provincia == id_provincia;
     });
     this.ciudades= result;
   }


  //Ubicacion
  public getPaises(){
    this.paisservice.getallPaises().subscribe(paises => this.paises = paises);
  }

  getCiudades() {
    this.ciudadservice.getallCiudades().subscribe(ciudades => this.ciudades_data = ciudades);
  }
  public getProvincias(){
    this.provinciaservice.getallProvinciaes().subscribe(provincias => this.provincias_data = provincias);
  }

  getDireciones() {
    this.direccionesservice.getallDirecciones().subscribe(direcciones => this.direcciones = direcciones);
  }
  public saveUser() {
    this.personaservice.savePersonas(this.persona).subscribe((res: any) => {
      this.saveUsuario(res.id_persona);
 })

  }
  saveUsuario(id_persona: any) {
    this.user.id_persona=id_persona;
    this.authService.register(this.user).subscribe((res: any) =>{
      localStorage.setItem('token', res.access_token);
      this.router.navigate(['/']);
 })
  }

}
