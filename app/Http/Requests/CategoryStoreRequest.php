<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Waavi\Sanitizer\Laravel\SanitizesInput;


class CategoryStoreRequest extends FormRequest
{
    use  SanitizesInput;
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
            'name' => 'required|min:3'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Kategori Tidak boleh kosong',
            'name.min' => 'Nama Kategori wajib lebih dari 3 character',
        ];
    }

    public function filters()
    {
        return [
            'name' => 'trim|lowercase|escape'
        ];
    }
}
