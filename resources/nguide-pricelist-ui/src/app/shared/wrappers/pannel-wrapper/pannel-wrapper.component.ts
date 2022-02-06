import { Component } from '@angular/core';
import {FieldWrapper} from '@ngx-formly/core';
import { environment } from 'src/environments/environment';
import {FormlyFieldConfigCustom} from '../../formly-field-config-custom';

@Component({
  selector: 'app-pannel-wrapper',
  templateUrl: './pannel-wrapper.component.html',
  styleUrls: ['./pannel-wrapper.component.scss']
})
export class PannelWrapperComponent extends FieldWrapper<FormlyFieldConfigCustom> {
  preview(event: any  ,i: number) {
    event.preventDefault();
    event.stopPropagation();
    const url = environment.apiBaseURL + 'resources/' + this.field.resourceName + '/' + this.field.resourceId + '/html?path=' + this.field.path.join('.') + '&template=' + this.to.preview;
    window.open(url, '_blank')?.focus();
  }
}
