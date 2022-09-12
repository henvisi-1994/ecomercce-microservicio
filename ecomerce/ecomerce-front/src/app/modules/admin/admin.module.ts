import { NgModule } from '@angular/core';
import { IndexComponent } from './index/index.component';
import { PedidosComponent } from './pedidos/pedidos.component';
import { AdminRoutingModule } from './admin-routing.module';
import { SharedModule } from '@shared/shared.module';





@NgModule({
  declarations: [
    IndexComponent,
    PedidosComponent
  ],
  imports: [
    SharedModule,
    AdminRoutingModule
  ]
})
export class AdminModule { }
