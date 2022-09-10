import { Router } from '@angular/router';
import { IUser } from './../../user/user/user.metadata';
import { AuthService } from '@data/services/api/auth.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  user: IUser = {
    id: 0,
    name: '',
    email: '',
    password: ''
  }
  constructor(private authService: AuthService, private router: Router) { }

  ngOnInit(): void {
  }

  public loginUser() {
    this.authService.login(this.user).subscribe((res: any) => {
      localStorage.setItem('token', res.access_token);
      if (res.is_empleado) {
        localStorage.setItem('id_empleado', res.id_empleado);
        this.router.navigate(['/admin/']);
      } else {
        localStorage.setItem('id_cliente', res.id_cliente);
        this.router.navigate(['/']);
      }
      // Guardo el objeto como un string
      localStorage.setItem('user', JSON.stringify(res.User));

    })
  }

}
