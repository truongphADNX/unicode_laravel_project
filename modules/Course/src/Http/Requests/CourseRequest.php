<?php

namespace Modules\Course\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'detail' => 'required',
            'teacher_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail(__('course::validation.select'));
                }
            }],
            'code' => 'required|max:255',
            'is_document' => 'required|integer',
            'status' => 'required|integer',
            'supports' => 'required',
            'thumbnail' => 'required|max:255',
            'categories' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => __('course::validation.required'),
            'max' => __('course::validation.max'),
            'integer' => __('course::validation.integer'),
            'select' => __('course::validation.select'),
        ];
    }

    public function attributes()
    {
        return __('course::validation.attributes');
    }
}
