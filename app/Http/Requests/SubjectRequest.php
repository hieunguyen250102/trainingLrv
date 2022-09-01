<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
        if ($this->route('subject')) {
            return [
                'name'=> 'required|min:6|max:32|unique:subjects,name,' . $this->route('subject'),
            ];
        }

        return [
            'name'=> 'required|unique:subjects|min:6|max:32',
        ];
    }
}
