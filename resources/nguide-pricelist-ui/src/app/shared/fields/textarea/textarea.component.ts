import {ChangeDetectionStrategy, Component, OnInit} from '@angular/core';
import {FieldType} from '@ngx-formly/core';
import {FormControl, Validators} from '@angular/forms';

@Component({
  selector: 'app-textarea',
  templateUrl: './textarea.component.html',
  styleUrls: ['./textarea.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class TextareaComponent extends FieldType implements OnInit {
  defaultOptions = {
    templateOptions: {
      cols: 1,
      rows: 1,
    },
  };
  valueControl = new FormControl('');
  language = '';
  ngOnInit(): void {
    const validators = [];
    if (this.valueControl) {
      if (this.to.required) {
        validators.push(Validators.required);
      }
      if (this.to.max) {
        validators.push(Validators.max(this.to.max));
      }
      if (this.to.maxLength) {
        validators.push(Validators.maxLength(this.to.maxLength));
      }
      if (this.to.min) {
        validators.push(Validators.min(this.to.min));
      }
      if (this.to.minLength) {
        validators.push(Validators.minLength(this.to.minLength));
      }
      if (this.to.pattern) {
        validators.push(Validators.pattern(this.to.pattern));
      }
      this.valueControl.setValidators(validators);
    }
    if (this.to?.translatable && this.to?.language) {
      this.to.language.subscribe((language: string) => {
        if (language) {
          this.language = language;
          const value = this.formControl.value && typeof this.formControl.value === 'object' && !Array.isArray(this.formControl.value) ? this.formControl.value[language] : '';
          this.valueControl.setValue(value);
        }
      })
    } else {
      this.valueControl.setValue(this.formControl.value || '');
    }

    this.valueControl.valueChanges.subscribe((value: any) => {
      setTimeout(() => this.formControl.setErrors(this.valueControl.errors));
      this.formControl.markAsTouched();
      if (this.to.translatable && this.language) {
        let newValue: any = this.formControl.value && typeof this.formControl.value === 'object' && !Array.isArray(this.formControl.value) ? this.formControl.value : {};
        newValue[this.language] = value;
        this.formControl.setValue(newValue)
      } else {
        this.formControl.setValue(value);
      }
    });
  }

}
