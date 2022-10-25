import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { UserRoutingModule } from './user-routing.module';
import { HomepagePage } from './homepage/homepage.page';
import { FooterComponent } from './components/footer/footer.component';


@NgModule({
  declarations: [
    HomepagePage,
    FooterComponent,
  ],
  imports: [
    CommonModule,
    UserRoutingModule
  ],
  exports: [
    FooterComponent
  ]
})
export class UserModule { }
