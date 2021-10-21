import {FieldType} from '@ngx-formly/core';
import {FormControl} from '@angular/forms';
import {requiredTranslated} from '../directives/required-translated.directive';

export class TranslatableType extends  FieldType {
  valueControl = new FormControl('');
  language = '';
  translatable = false;

  onInit(): void {
    if (this.to?.translatable && this.to?.language) {
      this.translatable = true;
      this.language = this.to.defaultLocale;
      this.to.language.subscribe((language: string) => {
        if (language) {
          const validators = [];
          this.language = language;
          if (this.to.required) {
            validators.push(requiredTranslated(language));
          }
          this.formControl.setValidators(validators);
          this.formControl.updateValueAndValidity();
          let value = '';
          if (this.formControl.value
            && typeof this.formControl.value === 'object'
            && !Array.isArray(this.formControl.value)
            && this.formControl.value.hasOwnProperty(this.language)) {
            value = this.formControl.value[this.language] || '';
          };
          this.valueControl.setValue(value, {emitEvent: false});
        }
      })
    } else {
      this.translatable = false;
      this.valueControl.setValue(this.formControl.value || '', {emitEvent: false});
    }

    this.valueControl.valueChanges.subscribe((value: any) => {
      if (this.to.translatable && this.language) {
        let newValue: any = this.formControl.value && typeof this.formControl.value === 'object' && !Array.isArray(this.formControl.value) ? {...this.formControl.value} : {};
        newValue[this.language] = value;
        this.formControl.setValue(newValue);
      } else {
        this.formControl.setValue(value);
      }
    });
  }

  get displayError(): boolean {
    return this.formControl?.invalid;
  }
}
