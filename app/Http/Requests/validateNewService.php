<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class validateNewService extends FormRequest
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
     * Get the validation rules that apply to the services input request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'slug' => ['required', 'string'],
            'status' => ['required', 'string'],
            'visibility' => ['required', 'string'],
            'type' => ['required', 'string'],
            'sku' => ['required', 'string','unique:services'],
            'regular_price' => ['required', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'description' => ['string'],
            'summary' => ['string'],
            'sale_price' => ['regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'taxable' => ['integer'],            
            'purchase_note' => ['string'],
            'meta_title' => ['string'],
            'meta_description' => ['string'],
            'sell_button_text' => ['string'],
            'downloadable' => ['integer'],
            'sale_start_date' => ['date'],
            'sale_end_date' => ['date'],
            'publish_at' => ['date'],
            'suspended_at' => ['date'],
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
