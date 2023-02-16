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
        $id = $this->route()->user;
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'group_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail(__('user::validation.select'));
                }
            }],
        ];

        if ($id) {
            $rules['username'] = 'required|max:50|unique:users,username,'.$id;
            $rules['email'] = 'required|email|unique:users,email,'.$id;
            if ($this->password) {
                $rules['password']  = 'min:6';
            }else{
                unset($rules['password']);
            }
        }
        return $rules;
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
            'name' => __('user::validation.name'),
            'username' => __('user::validation.username'),
            'email' => __('user::validation.email'),
            'password' => __('user::validation.password'),
            'group_id' => __('user::validation.group_id'),
        ];
    }
}
