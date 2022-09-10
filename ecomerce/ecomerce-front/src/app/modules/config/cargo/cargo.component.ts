import { environment } from './../../../../environments/environment.prod';
import { EmpresaService } from './../../../data/services/api/empresa.service';
import { EmpleadoService } from './../../../data/services/api/empleado.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap'
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core'
import { ICargo } from './cargo.metadata'
import { CargoService } from '@data/services/api/cargo.service'
import Swal from 'sweetalert2';

@Component({
  selector: 'app-cargo',
  templateUrl: './cargo.component.html',
  styleUrls: ['./cargo.component.css'],
})
export class CargoComponent implements OnInit {
  closeResult: string | undefined
  cargo: ICargo = {
    id_cargo: 0,
    id_emp:  environment.id_empresa,
    nomb_cargo: '',
    observ_cargo: '',
    estado_cargo: '',
    fecha_inicio: '',
    fecha_fin: '',
  }
  cargos:any = [];
  empresas:any = [];
  @ViewChild('cargoModal', { static: false }) modal: ElementRef | undefined
  edit = false
  constructor(private modalCargo: NgbModal, private cargoservice:CargoService, private empresaservice:EmpresaService) {}

  ngOnInit(): void {
    this.getCargos();
    this.getEmpresas();
  }
  getCargos() {
    this.cargoservice.getallCargos().subscribe(cargos => this.cargos = cargos);
  }
  getEmpresas(){
    this.empresaservice.getallEmpresas().subscribe(empresas=> this.empresas=empresas);
  }
  // Boton para abrir ventana modal
  open(content: any) {
    this.modalCargo
      .open(content, { ariaLabelledBy: 'modal-basic-title' })
      .result.then(
        (result) => {
          this.closeResult = `Closed with: ${result}`
        },
        (reason) => {
          this.closeResult = `Dismissed ${this.getDismissReason(reason)}`
        },
      )
  }
  // Cierra Ventana modal
  private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC'
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop'
    } else {
      return `with: ${reason}`
    }
  }
  public editCargo(cargo: any) {
    this.cargo.id_cargo = cargo.id_cargo
    this.cargo.nomb_cargo = cargo.nomb_cargo
   this.cargo.observ_cargo = cargo.observ_cargo
   this.cargo.fecha_inicio=cargo.fecha_inicio
   this.cargo.fecha_fin=cargo.fecha_fin
    this.cargo.estado_cargo = cargo.estado_cargo
    this.edit = true
    this.open(this.modal)
  }
  public borrarCargo(id_cargo: number) {
    this.cargoservice.deleteCargo(id_cargo).subscribe((res: any) => {
      this.modalCargo.dismissAll();
      this.getCargos();
      this.limpiar();
    })
  }
  public saveCargo() {
    this.edit ? this.updateCargo() : this.storeCargo()
  }
  public updateCargo() {
    this.cargoservice.updateCargo(this.cargo).subscribe((res: any) => {
      this.modalCargo.dismissAll();
      this.getCargos();
      this.limpiar();
      Swal.fire({
        title:'Cargo',
        text:'Cargo Actualizado Exitosamente',
        icon:'success'
      });
    })
  }
  public storeCargo() {
    this.cargoservice.saveCargo(this.cargo).subscribe((res: any) => {
      this.modalCargo.dismissAll();
      this.getCargos();
      this.limpiar();
      Swal.fire({
        title:'Cargo',
        text:'Cargo Creado Exitosamente',
        icon:'success'
      });
    })
  }
  private limpiar() {
    this.cargo.id_cargo = 0
    this.cargo.nomb_cargo = ''
    this.cargo.observ_cargo = ''
    this.cargo.fecha_inicio=''
    this.cargo.fecha_fin=''
    this.cargo.estado_cargo = ''
  }
}
