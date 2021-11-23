<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTechStackRequest extends FormRequest
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
            'name' => [
                'required', 'max:255', 'unique:tech_stacks'
            ],
            'description' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên công nghệ là trường bắt buộc.', 
            'name.max' => 'Tên công nghệ không được dài quá :max ký tự.', 
            'name.unique' => 'Tên công nghệ đã tồn tại.', 
            'description.required' => 'Mô tả là trường bắt buộc.', 
            'status.required' => 'Trạng thái là trường bắt buộc.', 
        ];
    }
}
