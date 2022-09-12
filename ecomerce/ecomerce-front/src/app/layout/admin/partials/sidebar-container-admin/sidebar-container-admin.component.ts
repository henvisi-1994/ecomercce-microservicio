import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-sidebar-container-admin',
  templateUrl: './sidebar-container-admin.component.html',
  styleUrls: ['./sidebar-container-admin.component.css']
})
export class SidebarContainerAdminComponent implements OnInit {
user:any;
  constructor(private router: Router) { }

  ngOnInit(): void {
    try {
      let  user = localStorage.getItem('user');
      this.user= JSON.parse(user+'')
    } catch (error) {

    }


  }
  logout() {
    localStorage.clear();
    this.router.navigate(['/']);
  }

}
