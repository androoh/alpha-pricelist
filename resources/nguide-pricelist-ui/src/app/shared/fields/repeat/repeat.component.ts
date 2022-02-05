import {Component} from '@angular/core';
import {FieldArrayType} from '@ngx-formly/core';
import {CdkDragDrop, moveItemInArray} from '@angular/cdk/drag-drop';
import { environment } from 'src/environments/environment';

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
  preview(event: any  ,i: number) {
    event.preventDefault();
    event.stopPropagation();
    const formElement: HTMLFormElement = document.createElement('form');
    formElement.setAttribute('target', '_blank');
    formElement.setAttribute('method', 'POST');
    formElement.setAttribute('action', environment.apiBaseURL + this.to?.preview);
    const inputElement: HTMLInputElement = document.createElement('input');
    inputElement.setAttribute('type', 'hidden');
    inputElement.setAttribute('name', 'content');
    formElement.appendChild(inputElement);
    const treeItem = this.formControl.at(i).value;
    if (treeItem !== null && this.to?.preview) {
      inputElement.value = JSON.stringify(treeItem);
      document.body.appendChild(formElement);
      formElement.submit();
      formElement.remove();
    }
  }
}
