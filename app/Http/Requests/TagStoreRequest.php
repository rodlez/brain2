<?php

namespace App\Http\Requests;

use App\Models\Sport\SportTag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|min:3|string|unique:sport_tags,name'
            /* 'name' => ['bail', 'required', 'min:3', 'string', Rule::unique(SportTag::class)->ignore($this->tag()->id)] */
        ];
    }
}
