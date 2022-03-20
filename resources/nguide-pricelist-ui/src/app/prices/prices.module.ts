import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PriceAssignComponent } from './price-assign/price-assign.component';
import {RouterModule, Routes} from '@angular/router';
import {ListComponent} from '../resources/list/list.component';
import {EditComponent} from '../resources/edit/edit.component';
import {NgxDatatableModule} from '@swimlane/ngx-datatable';
import {FormlyBootstrapModule} from '@ngx-formly/bootstrap';
import {FormlyModule} from '@ngx-formly/core';
import {PannelWrapperComponent} from '../shared/wrappers/pannel-wrapper/pannel-wrapper.component';
import {FileComponent} from '../shared/fields/file/file.component';
import {RepeatComponent} from '../shared/fields/repeat/repeat.component';
import {HasManyComponent} from '../shared/fields/has-many/has-many.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import { PreviewComponent } from './preview/preview.component';
import { ModifyPriceComponent } from './price-assign/modify-price/modify-price.component';

const routes: Routes = [
  {path: ':id', component: PriceAssignComponent},
  {path: 'preview/:id', component: PreviewComponent}
];

@NgModule({
  declarations: [
    PriceAssignComponent,
    PreviewComponent,
    ModifyPriceComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    NgxDatatableModule,
    RouterModule.forChild(routes),
    ReactiveFormsModule,
    FormlyBootstrapModule,
    FormlyModule.forChild({
      extras: { lazyRender: true },
      wrappers: [
        { name: 'panel', component: PannelWrapperComponent },
      ],
      types: [
        { name: 'images', component: FileComponent, wrappers: ['form-field'] },
        { name: 'repeat', component: RepeatComponent },
        { name: 'hasMany', component: HasManyComponent},
      ],
    }),
  ]
})
export class PricesModule { }
