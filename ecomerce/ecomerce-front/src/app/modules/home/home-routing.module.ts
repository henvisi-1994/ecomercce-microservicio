import { SearchProductComponent } from './search-product/search-product.component';
import { ProductoCategoriaComponent } from './producto-categoria/producto-categoria.component';
import { ProductDetailComponent } from './product-detail/product-detail.component';
import { HomeComponent } from './home/home.component';

import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CarShopComponent } from './car-shop/car-shop.component';



const routes: Routes = [{ path: '', component: HomeComponent },
{ path: 'detalle/:id', component: ProductDetailComponent },
{ path: 'categoria/:id', component: ProductoCategoriaComponent },
{ path: 'busqueda/:search', component: SearchProductComponent },
{ path: 'cart', component: CarShopComponent }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class HomeRoutingModule { }
