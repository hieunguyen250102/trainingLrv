<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->route('student')) {
            return [
                'name' => 'required|min:6|max:32',
                'email' => 'required|min:6|max:32|unique:students,email|email' . $this->route('student'),
                'avatar' => 'required|image',
                'phone' => 'required|numeric|min:10' . $this->route('student'),
                'birthday' => 'required|date',
                'address' => 'required',
                'gender' => 'required',
                'status' => 'required',
            ];
        }

        return [
            'name' => 'required|unique:students|min:6|max:32',
            'email' => 'required|min:6|max:32|unique:students,email|email',
            'birthday' => 'required|date',
            'gender' => 'required',
            'status' => 'required',
            'faculty_id' => 'required|exists:faculties,id',
        ];
    }
}
