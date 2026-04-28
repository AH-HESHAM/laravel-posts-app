<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title"=>"required | min:3 | unique('posts')->ignore(id)",
            "content"=>"required | min:10"
        ];
    }

    public function messages()
    {
        return ["title.min"=>"Post title must be at least 3 charecters"];
    }
}
