<?php

namespace App\Http\Requests\DataMaster;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'kode_kategori' => 'required|string',
            'nama_kategori' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'kode_kategori.required' => 'Kode kategori harus diisi',
            'nama_kategori.required' => 'Nama kategori harus diisi',
        ];
    }
}
