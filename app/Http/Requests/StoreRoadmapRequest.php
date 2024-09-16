<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoadmapRequest extends FormRequest
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
            'event_id'=>'required|unique:roadmaps,event_id',
            'jam_acara'=>'required|timezone|unique:roadmaps,jam_acara',
            'deskripsi_acara'=>'required|string|unique:roadmaps,deskripsi_acara'
        ];
    }
    public function messages(){
        return [
            'jam_acara.required' => 'Jam acara belum diisi',
            'jam_acara.timezone' => 'Format jam acara tidak sesuai',
            'jam_acara.unique' => 'Jam acara sudah ada',
            'deskripsi_acara.required' => 'Deskripsi acara belum diisi',
            'deskripsi_acara.string' => 'Format deskripsi acara tidak sesuai',
            'deskripsi_acara.unique' => 'Deskripsi acara sudah ada'
        ];
    }
}
