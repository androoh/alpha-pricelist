import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {ListComponent} from './list/list.component';
import {EditComponent} from './edit/edit.component';
import {RouterModule, Routes} from '@angular/router';
import {NgxDatatableModule} from '@swimlane/ngx-datatable';
import {FormlyBootstrapModule} from '@ngx-formly/bootstrap';
import {FormlyModule} from '@ngx-formly/core';
import {PannelWrapperComponent} from '../shared/wrappers/pannel-wrapper/pannel-wrapper.component';
import {FileComponent} from '../shared/fields/file/file.component';
import {RepeatComponent} from '../shared/fields/repeat/repeat.component';
import {HasManyComponent} from '../shared/fields/has-many/has-many.component';
import { FiltersComponent } from './filters/filters.component';
import {CollapseModule} from 'ngx-bootstrap/collapse';
import {BsDropdownModule} from 'ngx-bootstrap/dropdown';
import {TextareaComponent} from '../shared/fields/textarea/textarea.component';
import {DropdownWrapperComponent} from '../shared/wrappers/dropdown-wrapper/dropdown-wrapper.component';
import {TranslatableComponent} from '../shared/wrappers/translatable/translatable.component';
import {ReactiveFormsModule} from '@angular/forms';
import {InputComponent} from '../shared/fields/input/input.component';

const routes: Routes = [
  {path: ':name', component: ListComponent},
  {path: ':name/create', component: EditComponent},
  {path: ':name/:id/edit', component: EditComponent},
];

@NgModule({
  declarations: [
    ListComponent,
    EditComponent,
    FiltersComponent
  ],
  imports: [
    CommonModule,
    NgxDatatableModule,
    RouterModule.forChild(routes),
    CollapseModule.forRoot(),
    BsDropdownModule.forRoot(),
    FormlyBootstrapModule,
    ReactiveFormsModule,
    FormlyModule.forChild({
      extras: { lazyRender: true },
      wrappers: [
        { name: 'translatable', component: TranslatableComponent },
        { name: 'panel', component: PannelWrapperComponent },
        { name: 'layout', component: DropdownWrapperComponent },
      ],
      types: [
        { name: 'images', component: FileComponent, wrappers: ['form-field'] },
        { name: 'repeat', component: RepeatComponent },
        { name: 'hasMany', component: HasManyComponent},
        { name: 'translatable-textarea', component: TextareaComponent},
        { name: 'translatable-input', component: InputComponent},
      ],
    }),
  ]
})
export class ResourcesModule {
}
