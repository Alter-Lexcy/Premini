<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSponsorRequest extends FormRequest
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

            'nama_sponsor'=>'required|max:255|unique:sponsors,nama_sponsor,'
        ];
    }
    public function messages()
    {
        return[
            'nama_sponsor.required'=>'Nama Perusahaan Wajib Diisi',
            'nama_sponsor.unique'=>'Nama Perusahaan Sudah Ada'
        ];

    }
}
