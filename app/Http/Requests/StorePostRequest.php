<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postId = $this->route('post'); // gets {post} from route

        return [
            "title" => [
                "required",
                "min:3",
                Rule::unique('posts', 'title')->ignore($postId),
            ],
            "content" => "required|min:10",
        ];
    }

    public function messages()
    {
        return ["title.min"=>"Post title must be at least 3 charecters"];
    }
}
