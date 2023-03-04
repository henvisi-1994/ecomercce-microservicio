import { environment } from './../../../../environments/environment.prod';
import { EmpresaService } from './../../../data/services/api/empresa.service';
import { EmpleadoService } from './../../../data/services/api/empleado.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap'
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core'
import { ICargo } from './cargo.metadata'
import { CargoService } from '@data/services/api/cargo.service'
import Swal from 'sweetalert2';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-cargo',
  templateUrl: './cargo.component.html',
  styleUrls: ['./cargo.component.css'],
})
export class CargoComponent implements OnInit {
  closeResult: string | undefined;
  public cargoForm: FormGroup;
  cargos: any = [];
  empresas: any = [];
  @ViewChild('cargoModal', { static: false }) modal: ElementRef | undefined
  edit = false
  constructor(private modalCargo: NgbModal, private cargoservice: CargoService, private empresaservice: EmpresaService, private formBuilder: FormBuilder) {
    this.cargoForm = this.formBuilder.group({
      id_cargo: [''],
      id_emp: environment.id_empresa,
      nomb_cargo: ['', Validators.required, Validators.minLength(3), Validators.maxLength(255)],
      observ_cargo: ['', Validators.required, Validators.minLength(3), Validators.maxLength(255)],
      estado_cargo: ['', Validators.required, Validators.minLength(3), Validators.maxLength(255)],
      fecha_inicio: ['', Validators.required, Validators.minLength(3), Validators.maxLength(255)],
      fecha_fin: ['', Validators.required, Validators.minLength(3), Validators.maxLength(255)],
    });
  }

  ngOnInit(): void {
    this.getCargos();
    this.getEmpresas();
  }
  getCargos() {
    this.cargoservice.getallCargos().subscribe(cargos => this.cargos = cargos);
  }
  getEmpresas() {
    this.empresaservice.getallEmpresas().subscribe(empresas => this.empresas = empresas);
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
    this.cargoForm.setValue({
      id_cargo: cargo.id_cargo,
      nomb_cargo: cargo.nomb_cargo,
      observ_cargo: cargo.observ_cargo,
      fecha_inicio: cargo.fecha_inicio,
      fecha_fin: cargo.fecha_fin,
      estado_cargo: cargo.estado_cargo
    });
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
  get f(){
    return this.cargoForm.controls;
  }
  public saveCargo() {
    if (!this.cargoForm.valid) {
      return;
    }
    else {
      this.edit ? this.updateCargo() : this.storeCargo()
    }
  }
  public updateCargo() {
    this.cargoservice.updateCargo(this.cargoForm.value).subscribe((res: any) => {
      this.modalCargo.dismissAll();
      this.getCargos();
      this.limpiar();
      Swal.fire({
        title: 'Cargo',
        text: 'Cargo Actualizado Exitosamente',
        icon: 'success'
      });
    })
  }
  public storeCargo() {
    this.cargoservice.saveCargo(this.cargoForm.value).subscribe((res: any) => {
      this.modalCargo.dismissAll();
      this.getCargos();
      this.limpiar();
      Swal.fire({
        title: 'Cargo',
        text: 'Cargo Creado Exitosamente',
        icon: 'success'
      });
    })
  }
  private limpiar() {
    this.cargoForm.reset();
  }
}
