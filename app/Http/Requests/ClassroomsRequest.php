<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClassroomsRequest extends FormRequest
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
            "section"=>["nullable","string","max:191"],
            "subject"=>"nullable|string|max:191",
            "room"=>"nullable|string|max:191",
            "subject"=>"nullable|string|max:191",
            "status"=>"string",
            "cover_image"=>[
                $this->method()==="PUT"?"nullable":"required",
                Rule::imageFile()],
        ];
    }

    public function messages(): array
    {
        return [
            // "required"=>":attribute required!",
            "name.required"=>"الأسم مطلوب",
            "max"=>"يجب عليك إدخال نص حروفه أقل من :max",
            "cover_image.required"=>"يجب عليك تحميل صورة الغلاف"
        ];
    }
}
