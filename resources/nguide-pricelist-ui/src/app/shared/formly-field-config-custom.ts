import { FormlyFieldConfig } from "@ngx-formly/core";

export interface FormlyFieldConfigCustom extends FormlyFieldConfig {
  path: string[];
  resourceId: string | number;
  resourceName: string;
}
