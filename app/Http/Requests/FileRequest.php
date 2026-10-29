<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FileRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['pdf', 'image', 'doc', 'excel'])],
            'category_id' => ['required', 'exists:categories,id'],
            'file' => [
                $this->isMethod('POST') ? 'required' : 'nullable',
                'file',
                'max:10240',
                'mimes:jpg,jpeg,png,gif,webp,bmp,pdf,doc,docx,xls,xlsx,csv,txt',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'category_id.required' => 'Debes seleccionar una categoría.',
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'file.required' => 'Debes subir un archivo.',
            'file.max' => 'El archivo no puede superar los 10MB.',
            'file.mimes' => 'El formato del archivo no es válido.',
            'type.in' => 'El tipo de archivo no es válido.',
        ];
    }
}