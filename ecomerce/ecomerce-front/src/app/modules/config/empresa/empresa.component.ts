import { EmpresaService } from './../../../data/services/api/empresa.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap'
import { IEmpresa } from './empresa.metadata'
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core'

@Component({
  selector: 'app-empresa',
  templateUrl: './empresa.component.html',
  styleUrls: ['./empresa.component.css'],
})
export class EmpresaComponent implements OnInit {
  closeResult: string | undefined
  empresa: IEmpresa = {
    id_empresa: 0,
    razon_social: '',
    codigo_envio: '',
    nombre_comercial: '',
    ruc: '',
    fecha_inicio: '',
    fecha_fin: '',
    estado_empresa: '',
  }
  empresas:any = [ ]
  @ViewChild('empresaModal', { static: false }) modal: ElementRef | undefined
  edit = false
  constructor(private modalEmpresa: NgbModal,private empresaservice: EmpresaService) {}

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
    this.empresa.id_empresa = empresa.id_empresa
    this.empresa.razon_social = empresa.razon_social
    this.empresa.codigo_envio = empresa.codigo_envio
    this.empresa.nombre_comercial = empresa.nombre_comercial
    this.empresa.ruc = empresa.ruc
    this.empresa.fecha_inicio = empresa.fecha_inicio
    this.empresa.fecha_fin = empresa.fecha_fin
    this.empresa.estado_empresa = empresa.estado_empresa
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
    this.empresaservice.updateEmpresa(this.empresa).subscribe((res: any) => {
      this.modalEmpresa.dismissAll();
      this.geEmpresas();
      this.limpiar();
    })
  }
  public storeEmpresa() {
    this.empresaservice.saveEmpresa(this.empresa).subscribe((res: any) => {
      this.modalEmpresa.dismissAll();
      this.geEmpresas();
      this.limpiar();
    })
  }
  private limpiar() {
    this.empresa.id_empresa = 0
    this.empresa.razon_social = ''
    this.empresa.codigo_envio =''
    this.empresa.nombre_comercial = ''
    this.empresa.ruc = ''
    this.empresa.fecha_inicio =''
    this.empresa.fecha_fin =''
    this.empresa.estado_empresa = ''
  }
}
