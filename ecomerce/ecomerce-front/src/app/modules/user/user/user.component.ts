import { UsuarioService } from './../../../data/services/api/usuario.service';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { IUser } from './user.metadata';
import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {
  closeResult: string | undefined;
user:IUser={
  id:0,
  name:'',
  email:'',
  password:''
}
users:any=[];
@ViewChild('userModal', { static: false }) modal: ElementRef | undefined;
edit = false;
constructor(private modalUser: NgbModal, private userservice:UsuarioService) { }

  ngOnInit(): void {
    this.getUsers();
  }
  getUsers(){
    this.userservice.getallUsuarios().subscribe(users => this.users = users);
  }
  // Boton para abrir ventana modal
  open(content: any) {
    this.modalUser.open(content, { ariaLabelledBy: 'modal-basic-title' }).result.then((result) => {
      this.closeResult = `Closed with: ${result}`;
    }, (reason) => {
      this.closeResult = `Dismissed ${this.getDismissReason(reason)}`;
    });
  }
  // Cierra Ventana modal
  private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC';
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop';
    } else {
      return `with: ${reason}`;
    }
  }
  public editUser(user: any) {
    this.user.id = user.id;
    this.user.name = user.name;
    this.user.email = user.email,
    this.edit = true;
    this.open(this.modal);
  }
  public borrarUser(id: number) {
    this.userservice.deleteUsuario(id).subscribe((res: any) => {
      this.modalUser.dismissAll();
      this.getUsers();
      this.limpiar();
    })
  }
  public saveUser() {
    (this.edit ? this.updateUser() : this.storeUser());
  }
  public updateUser() {
    this.userservice.updateUsuario(this.user).subscribe((res: any) => {
      this.modalUser.dismissAll();
      this.getUsers();
      this.limpiar();
    })

  }
  public storeUser() {
    this.userservice.saveUsuario(this.user).subscribe((res: any) => {
      this.modalUser.dismissAll();
      this.getUsers();
      this.limpiar();
    })
  }
  private limpiar(){
    this.user.id = 0;
    this.user.name = "";
    this.user.email = ""
  }

}
