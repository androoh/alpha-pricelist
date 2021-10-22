<?php


namespace App\Formly;


class FormlyFieldConfig extends FormlyAbstract
{
    const FIELD_TYPE_SELECT = 'select';
    const FIELD_TYPE_INPUT = 'input';
    const FIELD_TYPE_INPUT_TRANSLATABLE = 'translatable-input';
    const FIELD_TYPE_FILE = 'file';
    const FIELD_TYPE_IMAGES = 'images';
    const FIELD_TYPE_TEXTAREA = 'textarea';
    const FIELD_TYPE_TEXTAREA_TRANSLATABLE = 'translatable-textarea';
    const FIELD_TYPE_REPEAT = 'repeat';
    const FIELD_TYPE_HAS_MANY = 'hasMany';
    const FIELD_TYPE_CHECKBOX = 'checkbox';
    /**
     * The key that relates to the model. This will link the field value to the model
     */
    public $key;

    /**
     * This should be a formly-field type added either by you or a plugin. More information over at Creating Formly Fields.
     */
    public $type;

    /**
     * Use `defaultValue` to initialize it the model. If this is provided and the value of the model at compile-time is undefined, then the value of the model will be assigned to `defaultValue`.
     */
    public $defaultValue;

    /**
     * This allows you to specify the `id` of your field. Note, the `id` is generated if not set.
     */
    public $id;

    /**
     * If you wish, you can specify a specific `name` for your field. This is useful if you're posting the form to a server using techniques of yester-year.
     */
    public $name;

    /**
     * This is reserved for the templates. Any template-specific options go in here. Look at your specific template implementation to know the options required for this.
     */
    public $templateOptions;

    /**
     * An object with a few useful properties
     * - `validation.messages`: A map of message names that will be displayed when the field has errors.
     * - `validation.show`: A boolean you as the developer can set to force displaying errors whatever the state of field. This is useful when you're trying to call the user's attention to some fields for some reason.
     */
    public $validation;

    /**
     * Used to set validation rules for a particular field.
     * Should be an object of key - value pairs. The value can either be an expression to evaluate or a function to run.
     * Each should return a boolean value, returning true when the field is valid. See Validation for more information.
     *
     * {
     *   validation?: (string | ValidatorFn)[];
     *   [key: string]: ((control: AbstractControl, field: FormlyFieldConfig) => boolean) | ({ expression: (control: AbstractControl, field: FormlyFieldConfig) => boolean, message: ValidationMessageOption['message'] });
     * }
     */
    public $validators;

    /**
     * Use this one for anything that needs to validate asynchronously.
     * Pretty much exactly the same as the validators api, except it must be a function that returns a promise.
     *
     * {
     *   validation?: (string | AsyncValidatorFn)[];
     *   [key: string]: ((control: AbstractControl, field: FormlyFieldConfig) => Promise<boolean> | Observable<boolean>) | ({ expression: (control: AbstractControl, field: FormlyFieldConfig) => Promise<boolean> | Observable<boolean>, message: string });
     * }
     */
    public $asyncValidators;

    /**
     * Can be set instead of `type` to render custom html content.
     */
    public $template;

    /**
     *  It is expected to be the name of the wrappers.
     *  The formly field template will be wrapped by the first wrapper, then the second, then the third, etc.
     *  You can also specify these as part of a type (which is the recommended approach).
     */
    public $wrappers;

    /**
     * Whether to hide the field. Defaults to false. If you wish this to be conditional use `hideExpression`
     */
    public $hide;

    /**
     * Whether to reset the value on hide or not. Defaults to `true`.
     */
    public $resetOnHide;

    /**
     * Conditionally hiding Field based on values from other Fields
     */
    public $hideExpression;

    /**
     * An object where the key is a property to be set on the main field config and the value is an expression used to assign that property.
     */
    public $expressionProperties;

    /**
     * You can specify your own class that will be applied to the `formly-field` component.
     */
    public $className;

    /**
     * Specify your own class that will be applied to the `formly-group` component.
     */
    public $fieldGroupClassName;

    /**
     * A field group is a way to group fields together, making advanced layout very simple.
     * It can also be used to group fields that are associated with the same model (useful if it's different than the model for the rest of the fields).
     */
    public $fieldGroup;

    public $fieldArray;

    /**
     * Whether to focus or blur the element field. Defaults to false. If you wish this to be conditional use `expressionProperties`
     */
    public $focus;


    /**
     * Array of functions to execute, as a pipeline, whenever the model updates, usually via user input.
     */
    public $parsers;

    /**
     * The model that stores all the data, where the model[key] is the value of the field
     */
    public $model;

    /**
     * The parent field.
     */
    public $parent;

    /**
     * The form options.
     */
    public $options;

    /**
     * Filterable field
     * @var $filterable
     */
    public $filterable;

    public $path;
}
