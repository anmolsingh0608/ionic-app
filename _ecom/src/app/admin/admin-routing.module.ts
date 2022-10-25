import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuardGuard } from '../shared/guards/auth-guard.guard';
import { DashboardPage } from './dashboard/dashboard.page';

const routes: Routes = [
  {
    path: '',
    loadChildren: () => import('./nav/nav.module').then( m => m.NavPageModule)
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule { }
