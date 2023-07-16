<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TopicsRequset extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>"required|string|max:255",
            "classroom_id"=>"required|exists:classrooms,id"
        ];
    }
      public function messages(): array
    {
        return [
            "required"=>":attribute is required",
            "name.max"=>":attribute must be less than :max",
            "classroom_id.exists"=>"classroom_id not exists"
        ];
    }
}
