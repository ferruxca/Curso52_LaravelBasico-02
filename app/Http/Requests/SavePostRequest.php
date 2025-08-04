<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePostRequest extends FormRequest
{

    public function authorize(): bool
    {
        //return true;
        return auth()->user()->hasRole('editor');
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'body' => 'required|string|min:10'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'El título es requerido',
            'title.min' => 'El título debe tener al menos 3 caracteres',
            'title.max' => 'El título no puede superar los 255 caracteres',
            'body.required' => 'El cuerpo es requerido',
            'body.min' => 'El cuerpo debe tener al menos 10 caracteres'
        ];
    }
}
