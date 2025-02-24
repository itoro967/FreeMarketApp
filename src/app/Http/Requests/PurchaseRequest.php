<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'payment' => 'sometimes|required',
            'post_code' => 'sometimes|required|regex:/^[0-9]{3}-[0-9]{4}$/',
            'address' => 'sometimes|required',
            'building' => 'sometimes|required',
        ];
    }
}
