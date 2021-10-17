import {Component, OnInit} from '@angular/core';
import {FieldArrayType} from '@ngx-formly/core';
import {CdkDragDrop, moveItemInArray} from '@angular/cdk/drag-drop';

@Component({
  selector: 'app-repeat',
  templateUrl: './repeat.component.html',
  styleUrls: ['./repeat.component.scss']
})
export class RepeatComponent extends FieldArrayType {
  drop(event: CdkDragDrop<string[]>) {
    if (this.field.fieldGroup) {
      const currentValue = this.formControl.value;
      moveItemInArray(this.field.fieldGroup, event.previousIndex, event.currentIndex);
      moveItemInArray(currentValue, event.previousIndex, event.currentIndex);
      this.formControl.setValue(currentValue);
    }
  }
}
