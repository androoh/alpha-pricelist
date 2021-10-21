import {ChangeDetectionStrategy, Component, OnInit} from '@angular/core';
import {TranslatableType} from '../translatable-type';

@Component({
  selector: 'app-textarea',
  templateUrl: './textarea.component.html',
  styleUrls: ['./textarea.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class TextareaComponent extends TranslatableType implements OnInit {
  defaultOptions = {
    templateOptions: {
      cols: 1,
      rows: 1,
    },
  };

  ngOnInit(): void {
    this.onInit();
  }
}
