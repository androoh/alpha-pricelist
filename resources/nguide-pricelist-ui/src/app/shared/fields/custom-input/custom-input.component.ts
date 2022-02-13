import { Component, ChangeDetectionStrategy, OnInit } from '@angular/core';
import { FieldType } from '@ngx-formly/core';

const uniqueId = (function () {
  let c = 0;
  const st = new Date();
  return function(prefix: string) {
      const t = (new Date()).getTime() - st.getTime();
      const r = Math.floor(Math.random() * 1000);
      let str;
      prefix = String(prefix) || '';
      str = '-' + c + '-' + t + '-' + r;
      c += 1;
      return prefix + str;
  }
}());

@Component({
  selector: 'app-custom-input',
  templateUrl: './custom-input.component.html',
  styleUrls: ['./custom-input.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class CustomInputComponent extends FieldType implements OnInit {
  ngOnInit(): void {
    if (this.type === 'hidden' && !this.formControl.value) {
      const generatedId = uniqueId('pricelist_');
      this.formControl.setValue(generatedId);
    }
  }

  get type() {
    return this.to.type || 'text';
  }
}
