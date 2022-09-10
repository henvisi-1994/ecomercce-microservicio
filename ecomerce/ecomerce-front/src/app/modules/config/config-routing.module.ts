import { ProductoComponent } from './producto/producto.component';
import { TipoIdentificacionComponent } from './tipo-identificacion/tipo-identificacion.component';
import { CargoComponent } from './cargo/cargo.component';
import { EmpleadosComponent } from './empleados/empleados.component';
import { MarcaComponent } from './marca/marca.component';
import { EmpresaComponent } from './empresa/empresa.component';
import { CategoriaComponent } from './categoria/categoria.component';
import { BodegaComponent } from './bodega/bodega.component';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ClientesComponent } from './clientes/clientes.component';
import { UbicacionComponent } from './ubicacion/ubicacion/ubicacion.component';


const routes: Routes = [{ path: 'bodega', component: BodegaComponent },
{ path: 'categoria', component: CategoriaComponent },
{ path: 'empresa', component: EmpresaComponent },
{path:'marca',component:MarcaComponent},
{path:'empleados',component:EmpleadosComponent},
{path:'clientes',component:ClientesComponent},
{path:'cargo',component:CargoComponent},
{path:'producto',component:ProductoComponent},
{path:'ubicacion',component:UbicacionComponent},
{path:'tipoidentificacion',component:TipoIdentificacionComponent}];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ConfigRoutingModule { }
