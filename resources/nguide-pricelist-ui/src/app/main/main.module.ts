import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {LayoutComponent} from './layout/layout.component';
import {FooterComponent} from './footer/footer.component';
import {HeaderComponent} from './header/header.component';
import {LeftSidebarComponent} from './left-sidebar/left-sidebar.component';
import {BodyComponent} from './body/body.component';
import {RouterModule, Routes} from '@angular/router';
import {MatSidenavModule} from '@angular/material/sidenav';
import {MatToolbarModule} from '@angular/material/toolbar';
import {MatIconModule} from '@angular/material/icon';
import {MatButtonModule} from '@angular/material/button';
import {NavbarComponent} from './navbar/navbar.component';
import {MatListModule} from '@angular/material/list';
import {FlexLayoutModule} from '@angular/flex-layout';
import {BreadcrumbsComponent} from './breadcrumbs/breadcrumbs.component';
import {DashboardComponent} from './dashboard/dashboard.component';
import {SharedModule} from '../shared/shared.module';
import { PagedjsComponent } from './pagedjs/pagedjs.component';
import {LoadingComponent} from './loading/loading.component';

@NgModule({
  declarations: [
    LayoutComponent,
    FooterComponent,
    HeaderComponent,
    LeftSidebarComponent,
    BodyComponent,
    NavbarComponent,
    BreadcrumbsComponent,
    DashboardComponent,
    PagedjsComponent,
    LoadingComponent
  ],
  exports: [
    LayoutComponent
  ],
    imports: [
        CommonModule,
        MatSidenavModule,
        MatToolbarModule,
        MatIconModule,
        MatButtonModule,
        MatListModule,
        FlexLayoutModule,
        RouterModule,
        SharedModule
    ]
})
export class MainModule {
}
