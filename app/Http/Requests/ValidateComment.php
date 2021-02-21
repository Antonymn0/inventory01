<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ValidateComment extends FormRequest
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
            'comment_by' => ['required', 'integer'],
            'approved_by' => ['required', 'integer'],
            'title' => ['string'],            
            'body' => ['required', 'string' ]            
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
