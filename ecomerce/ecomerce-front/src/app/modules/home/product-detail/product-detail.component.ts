import { AuthService } from './../../../data/services/api/auth.service';
import { ModalDismissReasons, NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { IDetallePedido } from './detalle-pedido.metadata';
import { DetallePedidoService } from './../../../data/services/api/detalle-pedido.service';
import { PedidoService } from './../../../data/services/api/pedido.service';
import { IPedido } from './pedido.metadata';
import { FormaPagoService } from './../../../data/services/api/forma-pago.service';
import { ProductoService } from './../../../data/services/api/producto.service';
import { Component, OnInit, ElementRef, ViewChild } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import Swal from 'sweetalert2';


@Component({
  selector: 'app-product-detail',
  templateUrl: './product-detail.component.html',
  styleUrls: ['./product-detail.component.css']
})
export class ProductDetailComponent implements OnInit {
  producto: any;
  pedido: IPedido = {
    id_pedido: 0,
    fecha_inicio: '',
    fecha_ult_mod: '',
    fecha_registro_ped: '',
    estado_ped: '',
    id_cliente: 0,
    id_formapago: 0,
    total: 0
  }
  detallePedido: IDetallePedido = {
    id_detalle_ped: 0,
    id_prod: 0,
    id_pedido: 0,
    cantidad: 1,
  }
  forpagos: any = [];
  isAuth: any;
  productos: any = [];
  constructor(
    private authService: AuthService,
    private productService: ProductoService,
    private formaPagoservice: FormaPagoService,
    private pedidoservice: PedidoService,
    private detallePedidoservice: DetallePedidoService,
    private detallepedidoservice:DetallePedidoService,
    private confirmDialog: NgbModal,
    private router: Router,
    private route: ActivatedRoute
  ) { }
  closeResult: string | undefined;
  @ViewChild('ConfirmDialog', { static: false }) modal: ElementRef | undefined;
  ngOnInit(): void {
    this.isAuth = this.authService.estaLogeado();
    this.route.paramMap.subscribe(params => {
      if (params.has('id')) {
        this.productService.getProducto(params.get("id")).subscribe(producto => this.producto = producto);
      }

    })
    this.getProductos();
    this.getFormaPagos();
  }
  // Boton para abrir ventana modal
  open(content: any) {
    this.confirmDialog.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
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
  getFormaPagos() {
    this.formaPagoservice.getallFormaPago().subscribe(r => { this.forpagos = r; })
  }
  public getProductos() {
    let id_cliente = localStorage.getItem('id_cliente');
    this.detallepedidoservice.getCart(id_cliente).subscribe(productos =>{ this.productos = productos  });
  }
  savePedido(id_prod: number, precio: number, aplica_iva: any) {
    let productos = this.productos.filter((producto: { id_prod: number; }) => {
      return producto.id_prod === id_prod;
    });

    if (productos.length == 0) {
      let id_cli = localStorage.getItem('id_cliente');
      this.pedido.id_cliente = Number.parseInt(id_cli + '');
      this.pedido.estado_ped = 'I';
      this.detallePedido.id_prod = id_prod;
      let precio_prod = 0;
      if (aplica_iva === 1) {
        precio_prod = this.calcularIva(precio);
      } else {
        precio_prod = precio;
      }
      this.pedido.total = precio_prod;
      if (localStorage.getItem('id_pedido',) != undefined) {
        let id_pedido_sotorage = parseInt(localStorage.getItem('id_pedido') + ' ');
        this.saveDetallePedido(id_pedido_sotorage);
      } else {
        this.pedidoservice.savePedido(this.pedido).subscribe((res: any) => {
          let id_pedido = res.id_pedido;
          localStorage.setItem('id_pedido', id_pedido);
          this.saveDetallePedido(id_pedido);
        })
      }
    } else {
      Swal.fire({
        title:'Producto',
        text:'El producto que desea agreagar ya se encuentra en su carrito de compras, porfavor elija otro producto',
        icon:'error'
      });
    }


  }
  calcularIva(precio: number) {
    let iva = precio * 0.12;
    return precio + iva;
  }
  saveDetallePedido(id_pedido: any) {
    this.detallePedido.id_pedido = id_pedido;
    this.detallePedidoservice.saveDetalle(this.detallePedido).subscribe((res: any) => {
      this.open(this.modal);
    })
  }
  continuar(nexCompra: boolean) {
    if (nexCompra) {
      this.router.navigate(['/']);
    } else {
      this.router.navigate(['/cart']);
      localStorage.removeItem('id_pedido');
      this.confirmDialog.dismissAll();
    }
  }

}
