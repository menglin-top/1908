<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePeoplePost extends FormRequest
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
            'username' => 'required|unique:people|max:12|min:2',
            'age' => 'required|integer|min:1|max:3',
            'card'=> 'required|integer:18|unique:people',
        ];
    }

    public function messages(){ 
        return [
            'username.required'=>'名字不能为空',
            'username.unique'=>'名字已存在',
            'username.max'=>'名字最长不能超过12',
            'username.min'=>'名字最短不能少于2位',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须为数字',
            'age.min'=>'年龄必须大于一位',
            'age.max'=>'年龄必须小于三位',
            'card.required'=>'身份证号不能为空',
            'card.integer'=>'身份证号必须18位',
            'card.unique'=>'身份证号已存在',
        ];
    }
}
