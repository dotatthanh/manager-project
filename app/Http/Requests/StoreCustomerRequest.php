<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
                'required', 'max:255',
            ],
            'description' => 'required',
            'priority' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên khách hàng là trường bắt buộc.', 
            'name.max' => 'Tên khách hàng không được dài quá :max ký tự.', 
            'description.required' => 'Mô tả là trường bắt buộc.', 
            'priority.required' => 'Trong số ưu tiên là trường bắt buộc.', 
            'status.required' => 'Trạng thái là trường bắt buộc.', 
        ];
    }
}
