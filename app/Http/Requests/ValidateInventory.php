<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidateInventory extends FormRequest
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
            'created_by'=>['required', 'integer'],
            'new_quantity'=>['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'available_quantity'=>['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'reason'=>['required', 'string'],
            'description'=>[ 'string'],
            'deleted_at'=>['date'],
            'suspended_at'=>['date'],
        ];
    }

      /**
     * Handle validation errors.
     *
     * @return response json
     */
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors(); 
        throw new HttpResponseException(response()->json(["errors" => $validator->errors()], 422));
    }
}
