<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'headerText' => 'required|string',
            'name' => 'string',
            'reference' => 'string|nullable',
            'user' => 'string|nullable',
            'password' => 'string|nullable',
            'pending' => 'boolean|nullable',
            'approved' => 'boolean|nullable',
            'rejected' => 'boolean|nullable',
            'cancelled' => 'boolean|nullable'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'El email es obligatorio.',
            'headerText.required' => 'El encabezado es obligatorio',
        ];
    }



}
