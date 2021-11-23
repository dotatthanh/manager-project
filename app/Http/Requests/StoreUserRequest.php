<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|confirmed|min:8|string',
            'name' => 'required|max:255', 
            'tech_stack_id' => 'required',
            'room_id' => 'required',
            'birthday' => 'required|date',
            'phone_number' => 'required|size:10',
            'address' => 'required',
            'card_id' => 'required|size:12',
            'foreign_language' => 'required',
            'experience' => 'required',
            'gender' => 'required',
            'roles' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là trường bắt buộc.', 
            'name.max' => 'Họ và tên không được dài quá :max ký tự.', 
            'gender.required' => 'Giới tính là trường bắt buộc.',
            'birthday.required' => 'Ngày sinh là trường bắt buộc.',
            'birthday.date' => 'Ngày sinh không đúng định dạng.',
            'phone_number.required' => 'Số điện thoại là trường bắt buộc.',
            'phone_number.size' => 'Số điện thoại phải là :size số.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email chưa đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.string' => 'Email phải là một chuỗi.',
            'email.max' => 'Email không được dài quá :max ký tự.',
            'roles.required' => 'Vai trò là trường bắt buộc.', 
            'tech_stack_id.required' => 'Công nghệ là trường bắt buộc!',
            'room_id.required' => 'Phòng ban là trường bắt buộc!',
            'password.required' => 'Mật khẩu là trường bắt buộc!',
            'password.confirmed' => 'Xác nhận mật khẩu không chính xác!',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự!',
            'password.string' => 'Mật khẩu phải là một chuỗi',
            'card_id.required' => 'Số căn cước là trường bắt buộc.',
            'card_id.size' => 'Số căn cước phải là :size số.',
            'foreign_language.required' => 'Ngoại ngữ là trường bắt buộc.',
            'experience.required' => 'Kinh nghiệm là trường bắt buộc.',
        ];
    }
}
