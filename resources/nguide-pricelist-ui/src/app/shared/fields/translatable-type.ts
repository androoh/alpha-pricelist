import {FieldType} from '@ngx-formly/core';
import {FormControl} from '@angular/forms';
import {requiredTranslated} from '../directives/required-translated.directive';

export class TranslatableType extends  FieldType {
  valueControl = new FormControl('');
  language = '';
  translatable = false;

  getDefaultTranslation(): string {
    return this.formControl.value[this.to.defaultLocale];
  }

  onInit(): void {
    this.translatable = true;
    this.language = this.to.defaultLocale;
    if (this.to?.language) {
      this.to.language.subscribe((language: string) => {
        if (language) {
          const validators = [];
          this.language = language;
          if (this.to.required) {
            validators.push(requiredTranslated(language));
          }
          this.formControl.setValidators(validators);
          this.formControl.updateValueAndValidity();
          this.updateValue();
        }
      });
    }

    this.valueControl.valueChanges.subscribe((value: any) => {
      let newValue: any = this.formControl.value && typeof this.formControl.value === 'object' && !Array.isArray(this.formControl.value) ? {...this.formControl.value} : {};
      newValue[this.language] = value;
      this.formControl.setValue(newValue);
    });
    // this.formControl.valueChanges.subscribe((value: any) => {
    //     this.updateValue();
    // });
  }

  updateValue(): void {
    let value = '';
    if (this.formControl.value
      && typeof this.formControl.value === 'object'
      && !Array.isArray(this.formControl.value)
      && this.formControl.value.hasOwnProperty(this.language)) {
      value = this.formControl.value[this.language] || '';
    };
    this.valueControl.setValue(value, {emitEvent: false});
  }

  get displayError(): boolean {
    return this.formControl?.invalid;
  }
}
