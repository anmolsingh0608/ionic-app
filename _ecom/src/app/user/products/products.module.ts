import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ProductsRoutingModule } from './products-routing.module';
import { ListPage } from './list/list.page';
import { ProductPage } from './product/product.page';
import { FooterComponent } from '../components/footer/footer.component';


@NgModule({
  declarations: [ListPage, ProductPage, FooterComponent],
  imports: [
    CommonModule,
    ProductsRoutingModule
  ]
})
export class ProductsModule { }
