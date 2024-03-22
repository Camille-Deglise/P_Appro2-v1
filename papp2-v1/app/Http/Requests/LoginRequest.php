<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'name' => ['required', 'string', 'regex:/^[-a-zA-ZÀ-ÿ]+$/'],
            'forname' => ['required', 'string', 'regex:/^[-a-zA-ZÀ-ÿ]+$/'],
            'pseudo' => ['required', 'string', 'regex:/^[a-zA-Z0-9\-\_]+$/'],
            'email'=> ['required','email', 'unique'], 
            'password'=> ['required', 'min:4'],
        ];
    }
}
