<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidateCoupon extends FormRequest
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
            'name'=> ['required','string'], 
            'slug'=>['required','string'],
            'code'=>['required','string'],
            'description'=>['required','string'],
            'discount_rate'=>['required','integer'],
            'start_date'=>['date'],
            'end_date'=>['date'],
            'usage_times'=>['required','integer'],
            'status'=>['date'],
            'deleted_at'=>['date'],
            'suspended_at'=>['date']
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
