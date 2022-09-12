import { ProvinciaService } from './../../../data/services/api/provincia.service';
import { environment } from './../../../../environments/environment.prod';
import { TipoIdentificacionService } from './../../../data/services/api/tipo-identificacion.service';
import { PersonaService } from './../../../data/services/api/persona.service';
import { DireccionService } from './../../../data/services/api/direccion.service';
import { EmpresaService } from './../../../data/services/api/empresa.service';
import { ClienteService } from './../../../data/services/api/cliente.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { IPersona } from './../../../data/interfaces/persona.metadata';
import { ICliente } from './cliente.metadata';
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import { ThisReceiver } from '@angular/compiler';
import Swal from 'sweetalert2';
import { PaisService } from '@data/services/api/pais.service';
import { CiudadService } from '@data/services/api/ciudad.service';
import { UsuarioService } from '@data/services/api/usuario.service';

@Component({
  selector: 'app-clientes',
  templateUrl: './clientes.component.html',
  styleUrls: ['./clientes.component.css']
})
export class ClientesComponent implements OnInit {
  closeResult: string | undefined;
  cliente: ICliente = {
    id_cliente: 0,
    tipo_cli: '',
    fecha_inicio: '',
    fecha_fin: '',
    email: '',
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
  id_pais: number = 0;
  id_provincia: number = 0;
  id_ciudad: number = 0;
  clientes: any = [];
  persona: IPersona = {
    id_persona: 0,
    nombre_persona: '',
    apellido_persona: '',
    dni: '',
    id_tipo_ident: 0
  }
  empresas: any = [];
  direcciones: any = [];
  tiposIdentificacion: any = [];
  paises: any = [];
  ciudades: any = [];
  ciudades_data: any = [];
  provincias: any = [];
  provincias_data: any = [];
  users: any = [];

  @ViewChild('clienteModal', { static: false }) modal: ElementRef | undefined;
  edit = false;
  constructor(private modalCliente: NgbModal,
    private clienteservice: ClienteService,
    private empresaservice: EmpresaService,
    private direccionesservice: DireccionService,
    private personaservice: PersonaService,
    private paisservice: PaisService,
    private ciudadservice: CiudadService,
    private provinciaservice: ProvinciaService,
    private userservice: UsuarioService,
    private tipoidentificacionservice: TipoIdentificacionService) { }

  ngOnInit(): void {
    this.getClientes();
    this.getEmpresas();
    this.getTipoIdentificaciones();
    this.getPaises();
    this.getProvincias();
    this.getCiudades();
    this.getDireciones();
    this.getUsers();
  }
  getUsers() {
    this.userservice.getallUsuarios().subscribe(users => this.users = users);
  }
  getDireciones() {
    this.direccionesservice.getallDirecciones().subscribe(direcciones => this.direcciones = direcciones);
  }
  getTipoIdentificaciones() {
    this.tipoidentificacionservice.getallTipoIdentificaciones().subscribe(tiposIdentificacion => this.tiposIdentificacion = tiposIdentificacion);
  }
  getClientes() {
    this.clienteservice.getallClientes().subscribe(clientes => this.clientes = clientes);
  }
  getEmpresas() {
    this.empresaservice.getallEmpresas().subscribe(empresas => this.empresas = empresas);
  }
  //Ubicacion
  public getPaises() {
    this.paisservice.getallPaises().subscribe(paises => this.paises = paises);
  }

  getCiudades() {
    this.ciudadservice.getallCiudades().subscribe(ciudades => this.ciudades_data = ciudades);
  }
  public getProvincias() {
    this.provinciaservice.getallProvinciaes().subscribe(provincias => this.provincias_data = provincias);
  }

  // Boton para abrir ventana modal
  open(content: any) {
    this.modalCliente.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
      this.closeResult = `Closed with: ${result}`;
    }, (reason) => {
      this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
    });
  }
  // Cierra Ventana modal
  private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC';
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop';
    } else {
      return `with: ${reason}`;
    }
  }
  public editCliente(cliente: any) {
    let result = this.direcciones.filter((direccion: string | any) => {
      return direccion.id_direccion === cliente.id_direccion;
    });
    let direccion = result[0];

    let resultUser = this.users.filter((usuario: string | any) => {
      return usuario.id === cliente.id_usu;
    });
    let usuario = resultUser[0];

    this.cliente.id_cliente = cliente.id_cliente;
    this.cliente.tipo_cli = cliente.tipo_cli;
    this.cliente.fecha_inicio = cliente.fecha_inicio,
      this.cliente.fecha_fin = cliente.fecha_fin,
      this.cliente.estado_cli = cliente.estado_cli;
    this.cliente.direcion = direccion.direcion;
    this.cliente.calle = direccion.calle;
    this.cliente.numero = direccion.numero;
    this.cliente.piso = direccion.piso;
    this.cliente.telefono = direccion.telefono;
    this.cliente.movil = direccion.movil;
    this.cliente.email = usuario.email;
    this.persona.nombre_persona = cliente.nombre_persona,
      this.persona.apellido_persona = cliente.apellido_persona,
      this.persona.id_tipo_ident = cliente.id_tipo_ident;
    this.persona.dni = cliente.dni;
    this.edit = true;
    this.open(this.modal);
  }
  public borrarCliente(id_cliente: number) {

  }
  public saveCliente() {
    (this.edit ? this.updateCliente() : this.storeCliente());
  }
  public updateCliente() {
    this.personaservice.updatePersona(this.persona).subscribe((res: any) => {
      this.actualizarCliente();
    });
  }
  actualizarCliente() {
    this.clienteservice.updateCliente(this.cliente).subscribe((res: any) => {
      this.modalCliente.dismissAll();
      this.getClientes();
      this.limpiar();
      Swal.fire({
        title: 'Cliente',
        text: 'Cliente Actualizado Exitosamente',
        icon: 'success'
      });
    })
  }
  public storeCliente() {

    this.personaservice.savePersonas(this.persona).subscribe((res: any) => {
      this.saveCli(res.id_persona);
    })
  }
  saveCli(id_persona: any) {
    this.cliente.id_persona = id_persona;
    this.clienteservice.saveClñiente(this.cliente).subscribe((res: any) => {
      this.modalCliente.dismissAll();
      this.getClientes();
      this.limpiar();
      Swal.fire({
        title: 'Cliente',
        text: 'Cliente Creado Exitosamente',
        icon: 'success'
      });
    })
  }
  private limpiar() {
    this.cliente.id_cliente = 0;
    this.cliente.tipo_cli = "";
    this.cliente.fecha_inicio = "",
      this.cliente.estado_cli = "";
  }
  onChangePais(event: any) {
    let id_pais = event.value
    let result = this.provincias_data.filter((provincia: string | any) => {
      return provincia.id_pais == id_pais;
    });
    this.provincias = result;
  }
  onChangeProvincia(event: any) {
    let id_provincia = event.value
    let result = this.ciudades_data.filter((ciudad: string | any) => {
      return ciudad.id_provincia == id_provincia;
    });
    this.ciudades = result;
  }

}
