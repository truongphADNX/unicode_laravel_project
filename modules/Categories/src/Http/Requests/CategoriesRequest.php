<?php

namespace Modules\Categories\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesRequest extends FormRequest
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
            'name' => 'required|max:200',
            'slug' => 'required|max:200',
            'parent_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'required' => __('categories::validation.required'),
            'max' => __('categories::validation.max'),
            'integer' => __('categories::validation.integer')
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('categories::validation.name'),
            'slug' => __('categories::validation.slug'),
            'parent_id' => __('categories::validation.parent_id')
        ];
    }
}
