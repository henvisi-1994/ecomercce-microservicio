import { EmpresaService } from './../../../data/services/api/empresa.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap'
import { IEmpresa } from './empresa.metadata'
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core'
import { FormBuilder, FormGroup, Validators } from '@angular/forms';

@Component({
  selector: 'app-empresa',
  templateUrl: './empresa.component.html',
  styleUrls: ['./empresa.component.css'],
})
export class EmpresaComponent implements OnInit {
  closeResult: string | undefined
  empresas:any = [ ]
  @ViewChild('empresaModal', { static: false }) modal: ElementRef | undefined
  edit = false
  public empresaForm: FormGroup;
  constructor(private modalEmpresa: NgbModal,private empresaservice: EmpresaService,private formBuilder: FormBuilder) {
    this.empresaForm = this.formBuilder.group({
      id_empresa: [''],
      razon_social: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      codigo_envio: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      nombre_comercial: ['', Validators.required,Validators.minLength(1), Validators.maxLength(255)],
      ruc: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      fecha_inicio: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      fecha_fin: ['', Validators.required, Validators.minLength(1), Validators.maxLength(255)],
      estado_empresa: ['', Validators.required, Validators.minLength(1), Validators.maxLength(1)],
    });
  }

  ngOnInit(): void {
    this.geEmpresas();
  }
  geEmpresas(){
    this.empresaservice.getallEmpresas().subscribe(empresas=> this.empresas=empresas);
  }
  // Boton para abrir ventana modal
  open(content: any) {
    this.modalEmpresa
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
  public editEmpresa(empresa: any) {
    this.empresaForm.setValue({ id_empresa : empresa.id_empresa,
    razon_social : empresa.razon_social,
    codigo_envio : empresa.codigo_envio,
    nombre_comercial : empresa.nombre_comercial,
    ruc : empresa.ruc,
    fecha_inicio : empresa.fecha_inicio,
    fecha_fin : empresa.fecha_fin,
    estado_empresa : empresa.estado_empresa});
    this.edit = true
    this.open(this.modal)
  }
  public borrarEmpresa(id_empresa: number) {
    this.empresaservice.deleteEmpresa(id_empresa).subscribe((res: any) => {
      this.modalEmpresa.dismissAll();
      this.geEmpresas();
      this.limpiar();
    })
  }
  public saveEmpresa() {
    this.edit ? this.updateEmpresa() : this.storeEmpresa()
  }
  public updateEmpresa() {
    this.empresaservice.updateEmpresa(this.empresaForm.value).subscribe((res: any) => {
      this.modalEmpresa.dismissAll();
      this.geEmpresas();
      this.limpiar();
    })
  }
  public storeEmpresa() {
    this.empresaservice.saveEmpresa(this.empresaForm.value).subscribe((res: any) => {
      this.modalEmpresa.dismissAll();
      this.geEmpresas();
      this.limpiar();
    })
  }
  private limpiar() {
    this.empresaForm.reset();
  }
}
