import { ConfigRoutingModule } from './config-routing.module';
import { NgModule } from '@angular/core';
import { CategoriaComponent } from './categoria/categoria.component';
import { MarcaComponent } from './marca/marca.component';
import { EmpresaComponent } from './empresa/empresa.component';
import { BodegaComponent } from './bodega/bodega.component';
import { ProductoComponent } from './producto/producto.component';
import { EmpleadosComponent } from './empleados/empleados.component';
import { ClientesComponent } from './clientes/clientes.component';
import { CargoComponent } from './cargo/cargo.component';
import { TipoIdentificacionComponent } from './tipo-identificacion/tipo-identificacion.component';
import { SharedModule } from '@shared/shared.module';
import { UbicacionComponent } from './ubicacion/ubicacion/ubicacion.component';
import { PaisComponent } from './ubicacion/pais/pais.component';
import { ProvinciaComponent } from './ubicacion/provincia/provincia.component';
import { CiudadComponent } from './ubicacion/ciudad/ciudad.component';
import { DireccionComponent } from './ubicacion/direccion/direccion.component';


@NgModule({
  declarations: [
    CategoriaComponent,
    MarcaComponent,
    EmpresaComponent,
    BodegaComponent,
    ProductoComponent,
    EmpleadosComponent,
    ClientesComponent,
    CargoComponent,
    TipoIdentificacionComponent,
    UbicacionComponent,
    PaisComponent,
    ProvinciaComponent,
    CiudadComponent,
    DireccionComponent
  ],
  imports: [
    SharedModule,
    ConfigRoutingModule
  ]
})
export class ConfigModule { }
