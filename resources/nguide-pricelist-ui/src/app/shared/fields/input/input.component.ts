import {ChangeDetectionStrategy, Component, OnInit} from '@angular/core';
import {TranslatableType} from '../translatable-type';

@Component({
  selector: 'app-input',
  templateUrl: './input.component.html',
  styleUrls: ['./input.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class InputComponent extends TranslatableType implements OnInit {
  ngOnInit(): void {
    this.onInit();
  }

  get type() {
    return this.to.type || 'text';
  }

}
