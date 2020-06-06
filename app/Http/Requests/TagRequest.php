<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
    public function rules()
    {

        return [
            'name' => 'required|min:3|unique:tags'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nama Tag Tidak boleh kosong',
            'name.min'      => 'Nama Tag wajib lebih dari 3 character',
            'unique'        => 'Nama tag sudah ada',
        ];
    }
}
