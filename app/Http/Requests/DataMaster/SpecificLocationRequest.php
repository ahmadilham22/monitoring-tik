<?php

namespace App\Http\Requests\DataMaster;

use Illuminate\Foundation\Http\FormRequest;

class SpecificLocationRequest extends FormRequest
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
            'location_id' => 'required',
            'kode_lokasi' => 'required|string',
            'lokasi_khusus' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'kode_lokasi.required' => 'Kode kategori harus diisi',
            'lokasi_khusus.required' => 'Nama kategori harus diisi',
        ];
    }
}
