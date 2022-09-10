import { NoAuthGuard } from './core/guards/no-auth.guard';
import { LoginComponent } from './modules/auth/login/login.component';
import { components } from './shared/components/index';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { SkeletonAdminComponent } from './layout/admin/skeleton-admin/skeleton-admin.component';
import { SkeletonComponent } from './layout/skeleton/skeleton.component';
import { RegisterComponent } from '@modules/auth/register/register.component';

const routes: Routes = [{
  path: "", component: SkeletonComponent, children: [{
    path: '', loadChildren: () =>
      import('./modules/home/home.module').then((m) => m.HomeModule)
  }]
}, {
  path: "admin", component: SkeletonAdminComponent, children: [
    {
      path: '',
      loadChildren: () =>
        import('./modules/admin/admin.module').then((m) => m.AdminModule)
    },
    {
      path: 'user',
      loadChildren: () =>
        import('./modules/user/user.module').then((m) => m.UserModule)
    },
    {
      path: 'config',
      loadChildren: () =>
        import('./modules/config/config.module').then((m) => m.ConfigModule)
    }
  ],
},
{path:"register",component:RegisterComponent,canActivate: [NoAuthGuard]},
{path:"login",component:LoginComponent,canActivate: [NoAuthGuard]}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
