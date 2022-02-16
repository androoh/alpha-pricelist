import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {DashboardComponent} from './main/dashboard/dashboard.component';
import {PagedjsComponent} from './main/pagedjs/pagedjs.component';
import { TranslationsComponent } from './main/translations/translations.component';

const routes: Routes = [
  {path: 'dashboard', component: DashboardComponent},
  {path: 'pdf', component: PagedjsComponent},
  {path: 'translations', component: TranslationsComponent},
  {path: 'resources', loadChildren: () => import('./resources/resources.module').then(m => m.ResourcesModule)},
  {path: 'price-assign', loadChildren: () => import('./prices/prices.module').then(m => m.PricesModule)},
  {path: '', redirectTo: '/dashboard', pathMatch: 'full'},
  {path: '**', redirectTo: '/dashboard'}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
