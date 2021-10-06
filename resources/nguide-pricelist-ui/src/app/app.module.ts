import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {NgxMaskModule} from 'ngx-mask';
import {SharedModule} from './shared/shared.module';
import {MainModule} from './main/main.module';
import {DynamicFormsMaterialUIModule} from '@ng-dynamic-forms/ui-material';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import {HttpClientModule} from '@angular/common/http';
import {DYNAMIC_MATCHER_PROVIDERS} from '@ng-dynamic-forms/core';
import {HashLocationStrategy, LocationStrategy} from '@angular/common';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    MainModule,
    ReactiveFormsModule,
    NgxMaskModule.forRoot(),
    DynamicFormsMaterialUIModule,
    SharedModule.forRoot(),
    BrowserAnimationsModule,
    HttpClientModule
  ],
  providers: [...DYNAMIC_MATCHER_PROVIDERS, {provide: LocationStrategy, useClass: HashLocationStrategy}],
  bootstrap: [AppComponent]
})
export class AppModule { }
