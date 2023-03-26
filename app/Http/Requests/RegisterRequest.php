<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|unique:users,username|min:4|alpha_dash:ascii',
            'gender' => 'required|max:1|in:M,F',
            'email' => 'required|email:dns,rfc|unique:users,email',
            'phone' => 'required|min_digits:12|numeric|unique:users,phone',
            'password' => "required|min:8|alpha_num",
            'address' => 'required|min:10'
        ];
    }
}
