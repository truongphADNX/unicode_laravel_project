<?php

namespace Modules\Teacher\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
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
        return [
            'name' => 'required"max:255',
            'slug' => 'required|max:255',
            'description' => 'required',
            'exp' => 'required|integer',
            'image' => 'required"255',
        ];
    }

    public function messages()
    {
        return [
            'required' => __('teacher::validation.required'),
            'max' => __('teacher::validation.max'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('teacher::validation.name'),
        ];
    }
}
