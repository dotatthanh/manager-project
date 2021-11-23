<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
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
                'required', 'max:255', 'unique:rooms'
            ],
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên phòng ban là trường bắt buộc.', 
            'name.max' => 'Tên phòng ban không được dài quá :max ký tự.', 
            'name.unique' => 'Tên phòng ban đã tồn tại.', 
            'description.required' => 'Mô tả là trường bắt buộc.', 
        ];
    }
}
