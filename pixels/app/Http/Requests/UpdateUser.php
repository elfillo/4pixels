<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
        $data = $this->request->all();
        $password_rule = isset($data['password']) ? 'min:6' : '';
        return [
            'name'          => 'required|string|min:2|',
            'email'         => 'sometimes|required|email|unique:users,id',
            'password'      => $password_rule
        ];
    }
}
