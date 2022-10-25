import { Component, OnInit } from '@angular/core';
import { ProductService } from '../services/product.service';

@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.page.html',
  styleUrls: ['./homepage.page.scss'],
})
export class HomepagePage implements OnInit {
  products: any[] = [];
  constructor(private productsService: ProductService) { }

  ngOnInit() {
    this.productsService.getProducts().subscribe((res: any) => {
      this.products = res.data;
      console.log(this.products);
    });

  }

  ionViewDidEnter() {
  }
}
