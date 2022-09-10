import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';
import { AuthService } from '@data/services/api/auth.service';

@Injectable({
  providedIn: 'root'
})
export class NoAuthGuard implements CanActivate {
  constructor(
    private router: Router,
    private authService: AuthService
  ) { }
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ) : boolean{
    if (this.authService.estaLogeado()) {
      switch(this.authService.tipoUser()){
        case 'Cliente':
          this.router.navigate(['/']);
          break;
          case 'Empleado':
            this.router.navigate(['admin']);
            break;
      }

      return false;
    } else {
      return true;
    }

  }


}
