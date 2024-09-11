<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SportStoreRequest extends FormRequest
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
            'tag'           => 'required',
            'category_id'   => 'required',
            'title'         => 'bail|required|min:3|string',
            'date'          => 'bail|required|date',
            'location'      => 'bail|required|min:4|string',
            'duration'      => 'bail|required|numeric',
            'distance'      => 'nullable|numeric',
            'info'          => 'bail|nullable|min:4',
        ];
    }
}
