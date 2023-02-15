<?php

namespace Modules\User\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route();

        dd($id);
        return [
            'fullName' => 'required|max:255',
            'userName' => 'required|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'group_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail(__('user::validation.select'));
                }
            }],
        ];
    }

    public function messages()
    {
        return [
            'required' => __('user::validation.required'),
            'max' => __('user::validation.max'),
            'min' => __('user::validation.min'),
            'unique' => __('user::validation.unique'),
            'email' => __('user::validation.email'),
            'integer' => __('user::validation.integer'),
        ];
    }

    public function attributes(){
        return [
            'fullName' => __('user::validation.fullName'),
            'userName' => __('user::validation.userName'),
            'email' => __('user::validation.email'),
            'password' => __('user::validation.password'),
            'group_id' => __('user::validation.group_id'),
        ];
    }
}
