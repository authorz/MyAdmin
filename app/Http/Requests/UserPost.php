<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPost extends FormRequest
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
            'Name' => 'required',
            'PassWord' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => '用户名必须填写',
            'PassWord.required' => '密码必须填写'
        ];
    }

}
