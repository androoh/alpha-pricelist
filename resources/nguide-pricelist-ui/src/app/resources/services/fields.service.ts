import {Injectable} from '@angular/core';
import {
  DynamicCheckboxModel,
  DynamicColorPickerModel,
  DynamicDatePickerModel,
  DynamicEditorModel,
  DynamicFormArrayModel,
  DynamicFormGroupModel,
  DynamicInputModel,
  DynamicRadioGroupModel,
  DynamicRatingModel,
  DynamicSelectModel,
  DynamicSliderModel,
  DynamicSwitchModel,
  DynamicTextAreaModel,
  DynamicTimePickerModel
} from '@ng-dynamic-forms/core';

export enum FieldType {
  DynamicInputModel = 'DynamicInputModel',
  DynamicDatePickerModel = 'DynamicDatePickerModel',
  DynamicTimePickerModel = 'DynamicTimePickerModel',
  DynamicCheckboxModel = 'DynamicCheckboxModel',
  DynamicColorPickerModel = 'DynamicColorPickerModel',
  DynamicSelectModel = 'DynamicSelectModel',
  DynamicEditorModel = 'DynamicEditorModel',
  DynamicSwitchModel = 'DynamicSwitchModel',
  DynamicTextAreaModel = 'DynamicTextAreaModel',
  DynamicRadioGroupModel = 'DynamicRadioGroupModel',
  DynamicRatingModel = 'DynamicRatingModel',
  DynamicSliderModel = 'DynamicSliderModel',
  DynamicFormGroupModel = 'DynamicFormGroupModel',
  DynamicFormArrayModel = 'DynamicFormArrayModel'

}

export class FieldModel {
  type: FieldType;
  options: any;

  constructor(props?: any) {
    this.type = props?.type ?? FieldType.DynamicInputModel;
    this.options = props?.options ?? {};
  }
}

@Injectable({
  providedIn: 'root'
})
export class FieldsService {

  toFormModel(layout: FieldModel[], result: any[] = []): any[] {
    for (const field of layout) {
      if (field.type) {
        switch (field.type) {
          case FieldType.DynamicCheckboxModel:
            result.push(new DynamicCheckboxModel(field.options));
            break;
          case FieldType.DynamicColorPickerModel:
            result.push(new DynamicColorPickerModel(field.options));
            break;
          case FieldType.DynamicDatePickerModel:
            result.push(new DynamicDatePickerModel(field.options));
            break;
          case FieldType.DynamicEditorModel:
            result.push(new DynamicEditorModel(field.options));
            break;
          case FieldType.DynamicFormArrayModel:
            const formArrayModel = new DynamicFormArrayModel(field.options);
            formArrayModel.groupFactory = () => this.toFormModel(field.options.groupFactory, [])
            result.push(formArrayModel);
            break;
          case FieldType.DynamicFormGroupModel:
            const formGroupModel = new DynamicFormGroupModel(field.options);
            formGroupModel.group = this.toFormModel(field.options.group, []);
            result.push(formGroupModel);
            break;
          case FieldType.DynamicInputModel:
            result.push(new DynamicInputModel(field.options));
            break;
          case FieldType.DynamicRadioGroupModel:
            result.push(new DynamicRadioGroupModel(field.options));
            break;
          case FieldType.DynamicRatingModel:
            result.push(new DynamicRatingModel(field.options));
            break;
          case FieldType.DynamicSelectModel:
            result.push(new DynamicSelectModel(field.options));
            break;
          case FieldType.DynamicSliderModel:
            result.push(new DynamicSliderModel(field.options));
            break;
          case FieldType.DynamicSwitchModel:
            result.push(new DynamicSwitchModel(field.options));
            break;
          case FieldType.DynamicTextAreaModel:
            result.push(new DynamicTextAreaModel(field.options));
            break;
          case FieldType.DynamicTimePickerModel:
            result.push(new DynamicTimePickerModel(field.options));
            break;
        }
      }
    }
    return result;
  }
}
