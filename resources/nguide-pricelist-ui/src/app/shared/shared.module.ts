import {ModuleWithProviders, NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {ResourcesService} from './services/resources.service';
import {PannelWrapperComponent} from './wrappers/pannel-wrapper/pannel-wrapper.component';
import {FileComponent} from './fields/file/file.component';
import {FormlyModule} from '@ngx-formly/core';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {FileValueAccessorDirective} from './directives/file-value-accessor.directive';
import {RepeatComponent} from './fields/repeat/repeat.component';
import {HasManyComponent} from './fields/has-many/has-many.component';
import {NgxDatatableModule} from '@swimlane/ngx-datatable';
import {ModalModule} from 'ngx-bootstrap/modal';
import {AddNewModalComponent} from './fields/has-many/add-new-modal/add-new-modal.component';
import {TypeaheadModule} from 'ngx-bootstrap/typeahead';
import {FileUploadModule} from 'ng2-file-upload';
import {HTTP_INTERCEPTORS} from '@angular/common/http';
import {ApiService} from './interceptors/api.service';
import {AlertsComponent} from './components/alerts/alerts.component';
import {AlertsService} from './services/alerts.service';
import {AlertModule} from 'ngx-bootstrap/alert';
import {TableService} from './services/table.service';
import {AccordionModule} from 'ngx-bootstrap/accordion';
import {TextareaComponent} from './fields/textarea/textarea.component';
import {QuillModule} from 'ngx-quill';
import {DropdownWrapperComponent} from './wrappers/dropdown-wrapper/dropdown-wrapper.component';
import {PopoverModule} from 'ngx-bootstrap/popover';
import {BreadcrumbService} from './services/breadcrumb.service';
import {LoadingService} from './services/loading.service';
import {LoadingInterceptorService} from './interceptors/loading-interceptor.service';
import {TranslatableComponent} from './wrappers/translatable/translatable.component';
import {InputComponent} from './fields/input/input.component';
import {DragDropModule} from '@angular/cdk/drag-drop';
import { HasManyCascadeComponent } from './fields/has-many-cascade/has-many-cascade.component';
import { CustomInputComponent } from './fields/custom-input/custom-input.component';

@NgModule({
  declarations: [
    PannelWrapperComponent,
    FileComponent,
    FileValueAccessorDirective,
    RepeatComponent,
    HasManyComponent,
    AddNewModalComponent,
    AlertsComponent,
    TextareaComponent,
    DropdownWrapperComponent,
    TranslatableComponent,
    InputComponent,
    HasManyCascadeComponent,
    CustomInputComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    ReactiveFormsModule,
    FormlyModule,
    DragDropModule,
    NgxDatatableModule,
    ModalModule.forRoot(),
    TypeaheadModule.forRoot(),
    FileUploadModule,
    AlertModule.forRoot(),
    AccordionModule.forRoot(),
    PopoverModule.forRoot(),
    QuillModule.forRoot({
      modules: {
        toolbar: [
          ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
          ['blockquote', 'code-block'],

          [{'header': 1}, {'header': 2}],               // custom button values
          [{'list': 'ordered'}, {'list': 'bullet'}],
          [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
          [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent

          [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
          [{'header': [1, 2, 3, 4, 5, 6, false]}],

          [{'color': []}, {'background': []}],          // dropdown with defaults from theme
          [{'font': []}],
          [{'align': []}],

          ['clean']
        ]
      }
    })
  ],
  exports: [
    PannelWrapperComponent,
    FileComponent,
    FileValueAccessorDirective,
    RepeatComponent,
    HasManyComponent,
    AlertsComponent,
    TextareaComponent,
    DropdownWrapperComponent,
    TranslatableComponent,
    InputComponent,
    CustomInputComponent
  ]
})
export class SharedModule {
  public static forRoot(): ModuleWithProviders<SharedModule> {
    return {
      ngModule: SharedModule,
      providers: [
        AlertsService,
        TableService,
        ResourcesService,
        BreadcrumbService,
        LoadingService,
        {
          provide: HTTP_INTERCEPTORS,
          useClass: ApiService,
          multi: true,
        },
        {
          provide: HTTP_INTERCEPTORS,
          useClass: LoadingInterceptorService,
          multi: true,
        }
      ]
    };
  }
}
