<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
        /* return [
            'image' => 'required|mimes:pdf,jpeg,png,jpg,gif|max:2048'
        ]; */

        //dd('oli');

        // Validate incoming request data
        return [
            'files' => 'required|array',
            'files.*' => 'required|mimes:php,pdf,jpeg,png,jpg,xlx,csv|max:2048',
        ];
    }
}
