<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ResourceRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }


    public function getResourceClassName($name)
    {
        $className = Str::ucfirst(Str::camel($name));
        return "\App\Resources\\$className";

    }

    /**
     * Get Resource Object by name
     * @param $name
     * @return mixed
     */
    public function getResource($name)
    {
        $className = $this->getResourceClassName($name);
        if (class_exists($className)) {
            return new $className();
        }
        throw new \Exception("The resource {$name} doesn't exists!");
    }
}
