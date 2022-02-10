import {ChangeDetectionStrategy, Component} from '@angular/core';
import {FieldArrayType} from '@ngx-formly/core';
import {CdkDragDrop, moveItemInArray} from '@angular/cdk/drag-drop';
import { environment } from 'src/environments/environment';
import {FormlyFieldConfigCustom} from '../../formly-field-config-custom';

@Component({
  selector: 'app-repeat',
  templateUrl: './repeat.component.html',
  styleUrls: ['./repeat.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class RepeatComponent extends FieldArrayType<FormlyFieldConfigCustom> {
  drop(event: CdkDragDrop<string[]>) {
    if (this.field.fieldGroup) {
      const currentValue = this.formControl.value;
      moveItemInArray(this.field.fieldGroup, event.previousIndex, event.currentIndex);
      moveItemInArray(currentValue, event.previousIndex, event.currentIndex);
      this.formControl.setValue(currentValue);
    }
  }


  preview(event: any  ,i: number) {
    event.preventDefault();
    event.stopPropagation();
    let path = this.field.path.join('.');
    path += '.' + i;
    const url = environment.apiBaseURL + 'resources/' + this.field.resourceName + '/' + this.field.resourceId + '/html?path=' + path + '&template=' + this.to.preview;
    window.open(url, '_blank')?.focus();
  }
}
