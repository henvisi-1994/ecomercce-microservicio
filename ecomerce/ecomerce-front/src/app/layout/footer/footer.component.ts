import { CategoriaService } from './../../data/services/api/categoria.service';
import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.css']
})
export class FooterComponent implements OnInit {
  categorias:any = [];
  constructor(private categoriasaservice:CategoriaService) { }

  ngOnInit(): void {
    this.getCategorias();
  }
  getCategorias(){
    this.categoriasaservice.getallCategorias().subscribe(categorias=> this.categorias=categorias);
  }

}
