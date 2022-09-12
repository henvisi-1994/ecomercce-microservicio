import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { DetallePedidoService } from './../../../data/services/api/detalle-pedido.service';
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';
import { PedidoService } from '@data/services/api/pedido.service';

@Component({
  selector: 'app-pedidos',
  templateUrl: './pedidos.component.html',
  styleUrls: ['./pedidos.component.css']
})
export class PedidosComponent implements OnInit {
  pedidos: any = [];
  closeResult: string | undefined;
  detallepedidos: any = [];
  @ViewChild('detallePedidoModal', { static: false }) modal: ElementRef | undefined;
  constructor(private pedidoservices: PedidoService, private detallepedidoservice: DetallePedidoService, private modalDetalle: NgbModal) { }
  // Boton para abrir ventana modal
  open(content: any) {
    this.modalDetalle.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
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
  ngOnInit(): void {
    this.getPedidos();
  }
  getPedidos() {
    this.pedidoservices.getallPedido().subscribe(pedidos => this.pedidos = pedidos);
  }
  enviarPedido(id_pedido: number) {
    this.pedidoservices.enviarPedido(id_pedido).subscribe((res: any) => {
      this.getPedidos();
    })
  }
  getDetalle(id_pedido: number) {
    this.detallepedidoservice.getDetalle(id_pedido).subscribe(detallepedidos => this.detallepedidos = detallepedidos);
    this.open(this.modal);
  }
  calcularIVA(precio: number) {
    let iva = precio * 0.12;
    return precio + iva;
  }
}



