import { ChatDialogComponent } from './chat-dialog/chat-dialog.component';
import { SharedModule } from './../../shared/shared.module';
import { CUSTOM_ELEMENTS_SCHEMA, NgModule } from '@angular/core';
import { HomeComponent } from './home/home.component';
import { HomeRoutingModule } from './home-routing.module';
import { ProductDetailComponent } from './product-detail/product-detail.component';
import { CarShopComponent } from './car-shop/car-shop.component';
import { ProductoCategoriaComponent } from './producto-categoria/producto-categoria.component';
import { SearchProductComponent } from './search-product/search-product.component';




@NgModule({
  declarations: [
    HomeComponent,
    ProductDetailComponent,
    CarShopComponent,
    ChatDialogComponent,
    ProductoCategoriaComponent,
    SearchProductComponent
  ],
  schemas:[CUSTOM_ELEMENTS_SCHEMA],

  imports: [
    SharedModule,
    HomeRoutingModule
  ]
})
export class HomeModule { }
