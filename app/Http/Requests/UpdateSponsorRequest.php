<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSponsorRequest extends FormRequest
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
            'nama_sponsor' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sponsors', 'nama_sponsor')->ignore($this->sponsor->id)
            ]

        ];
    }

    public function messages()
    {
        return [
            'nama_sponsor.required' => 'Nama Perusahaan Belum diisi',
            'nama_sponsor.unique' => 'Nama Sudah Ada'
        ];
    }
}
