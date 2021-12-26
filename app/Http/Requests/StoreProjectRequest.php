<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
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
                Rule::unique('projects')->ignore($this->project),
            ],
            'description' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'type_id' => 'required',
            'room_id' => 'required',
            'customer_id' => 'required',
            'tech_stacks' => 'required',
            'start_date' => 'required|date', 
            'end_date' => 'required|date|after_or_equal:start_date', 
            'users' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên dự án là trường bắt buộc.', 
            'name.max' => 'Tên dự án không được dài quá :max ký tự.', 
            'name.unique' => 'Tên dự án đã tồn tại.', 
            'description.required' => 'Mô tả là trường bắt buộc.', 
            'priority.required' => 'Trong số ưu tiên là trường bắt buộc.', 
            'status.required' => 'Trạng thái là trường bắt buộc.', 
            'start_date.required' => 'Ngày bắt đầu là trường bắt buộc.',
            'start_date.date' => 'Ngày bắt đầu không đúng định dạng.',
            'end_date.required' => 'Ngày kết thúc là trường bắt buộc.',
            'end_date.date' => 'Ngày kết thúc không đúng định dạng.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
            'type_id.required' => 'Loại dự án là trường bắt buộc.', 
            'room_id.required' => 'Phòng ban là trường bắt buộc.', 
            'customer_id.required' => 'Khách hàng là trường bắt buộc.', 
            'tech_stacks.required' => 'Công nghệ là trường bắt buộc.', 
            'users.required' => 'Nhân sự là trường bắt buộc.', 
        ];
    }
}
