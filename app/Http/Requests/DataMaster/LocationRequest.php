<?php

namespace App\Http\Requests\DataMaster;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
        $locationId = $this->route('location.index') ? $this->route('location.index')->id : null;

        return [
            'lokasi' => [
                'required',
                'string',
                Rule::unique('locations')->ignore($locationId),
            ],
        ];
    }

    public function messages()
    {
        return [
            'lokasi.required' => 'Nama kategori harus diisi',
            'lokasi.unique' => 'Nama kategori sudah ada. Harap pilih nama yang lain.',
        ];
    }
}
