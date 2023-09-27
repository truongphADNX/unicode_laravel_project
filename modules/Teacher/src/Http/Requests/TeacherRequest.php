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
        $id = $this->route()->teacher;
        $unique = 'unique:teachers,slug,' . $id;

        return [
            'name' => 'required|max:255',
            'slug' => 'required|max:255|' . $unique,
            'description' => 'required',
            'exp' => 'required|numeric',
            'image' => 'required|max:255',
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
            'slug' => __('teacher::validation.slug'),
            'exp' => __('teacher::validation.exp'),
            'description' => __('teacher::validation.description'),
            'image' => __('teacher::validation.image'),
        ];
    }
}
