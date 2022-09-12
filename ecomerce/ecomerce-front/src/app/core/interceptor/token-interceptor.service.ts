import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpRequest, HttpHandler, HttpEvent, HttpXsrfTokenExtractor } from '@angular/common/http';
import { Observable } from 'rxjs';
import { AuthService } from '@data/services/api/auth.service';

@Injectable({
  providedIn: 'root'
})
export class TokenInterceptorService implements HttpInterceptor {

  constructor( private authService: AuthService,private tokenService: HttpXsrfTokenExtractor) {}
// Implementaciòn del metodo
  intercept(req: HttpRequest<any>, next: HttpHandler){
    const tokenizeReq = req.clone({
      setHeaders: {
        Authorization: `Bearer ${this.authService.getToken()}`,
        'X-XSRF-TOKEN': `${this.tokenService.getToken()}`
      }
    });
    return next.handle(tokenizeReq);
  }

}
