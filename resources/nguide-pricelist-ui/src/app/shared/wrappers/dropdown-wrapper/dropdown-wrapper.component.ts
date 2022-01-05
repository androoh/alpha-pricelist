import {Component} from '@angular/core';
import {FieldWrapper} from '@ngx-formly/core';

@Component({
  selector: 'app-dropdown-wrapper',
  templateUrl: './dropdown-wrapper.component.html',
  styleUrls: ['./dropdown-wrapper.component.scss']
})
export class DropdownWrapperComponent extends FieldWrapper {

  getImg(): string | undefined {
    if (this.formControl.value) {
      const item = (this.field.templateOptions?.options as any[] || []).find((item: any) => item.value === this.formControl.value);
      return item?.img;
    }
    return undefined;
  }
}
