import {AbstractControl, ValidationErrors, ValidatorFn} from '@angular/forms';

export function requiredTranslated(language: string): ValidatorFn {
  return (control: AbstractControl): ValidationErrors | null => {
    const forbidden = control.value && typeof control.value === 'object' && control.value.hasOwnProperty(language) ? control.value[language].length === 0 : true;
    return forbidden ? {required: {value: control.value}} : null;
  };
}
