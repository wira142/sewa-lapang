<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldRequest extends FormRequest
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
            "title" => "required|min:4",
            "image" => ["image", "mimes:png,jpg", "max:2048"],
            "desc" => "required|min:50",
            "disc" => "required|min:0",
            "min_time" => "required|min:0",
            "status" => "required|min:0",
            "price" => "required|min:0",
            "map_link" => "required|url",
        ];
    }
}
