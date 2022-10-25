import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ListPage } from './list/list.page';
import { ProductPage } from './product/product.page';

const routes: Routes = [
  {
    path: 'all',
    component: ListPage
  },
  {
    path: ':id',
    component: ProductPage
  },
  {
    path: '',
    redirectTo: 'all',
    pathMatch: 'full'
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class ProductsRoutingModule { }
