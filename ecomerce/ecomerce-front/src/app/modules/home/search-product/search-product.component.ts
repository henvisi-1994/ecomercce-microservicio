import { Router, ActivatedRoute } from '@angular/router';
import { Component, OnInit } from '@angular/core';
import { ProductoService } from '@data/services/api/producto.service';

@Component({
  selector: 'app-search-product',
  templateUrl: './search-product.component.html',
  styleUrls: ['./search-product.component.css']
})
export class SearchProductComponent implements OnInit {
  productos: any=[];
  search:any='';

  constructor(private productService:ProductoService,
    private router: Router,
    private route: ActivatedRoute) { }

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      if (params.has('search')) {
        this.search=params.get("search");
        this.productService.getActivoProductos().subscribe(r=>{
          this.productos= this.busqueda(r);
        })
      }
    })
  }
  busqueda(data: any): any {
    return data.filter((item: { present_prod: any; descripcion_prod: any; }) => {
      return (item.present_prod	 + item.descripcion_prod )
        .toLowerCase()
        .includes(this.search.toLowerCase())
    });
  }


}
