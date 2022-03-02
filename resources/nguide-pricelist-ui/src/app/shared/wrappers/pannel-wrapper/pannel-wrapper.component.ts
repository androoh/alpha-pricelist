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
  language = 'en';

  ngOnInit(): void {
    if (this.to?.language) {
      this.to.language.subscribe((language: string) => {
        if (language) {
          this.language = language;
        }
      })
    }
  }

  preview(event: any  ,i: number) {
    event.preventDefault();
    event.stopPropagation();
    const url = environment.apiBaseURL + 'resources/' + this.field.resourceName + '/' + this.field.resourceId + '/html?path=' + this.field.path.join('.') + '&template=' + this.to.preview + '&locale=' + this.language;
    window.open(url, '_blank')?.focus();
  }
}
