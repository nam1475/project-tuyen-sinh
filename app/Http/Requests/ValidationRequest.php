<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
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
            'HoTen' =>['required', 'min:3', 'max:20'],
            'NgaySinh' =>'required',
            'GioiTinh' =>'required|in:Nam,Nữ',
            'TrinhDoVanHoa' =>'required|in:THCS,THPT',
            'SDT' =>'required|max:12',
            'DiaChi' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'HoTen.required' => 'Vui lòng nhập trường này.',
            'NgaySinh.required' => 'Vui lòng nhập trường này.',
            'GioiTinh.in' =>'Vui lòng nhập trường này.',
            'TrinhDoVanHoa.in' => 'Vui lòng nhập trường này.',
            'SDT.required' => 'Vui lòng nhập trường này.',
            'SDT.max'=> 'SĐT không được quá 12 số',
            'DiaChi.required' => 'Vui lòng nhập trường này.',
        ];
    }
}
