<?php

namespace App\Http\Requests\Pedido;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            
            'suelas' => 'required|array',
            'suelas.suela' => 'integer',
            'suelas.pares' => 'integer',
            'suelas.precio' => 'numeric',
            'cliente' => 'required|integer',
            'observaciones' => 'string|nullable',
            'entrega' => 'string|nullable',
            'lote' => 'string|nullable',
            'acomodo' => 'string|nullable',

        ];
    }
}
