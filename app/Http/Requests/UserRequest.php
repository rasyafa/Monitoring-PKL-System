<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'role' => 'required|in:siswa,pembimbing,mitra,mentor,admin',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string',
            'city' => 'required|string|max:255',
        ];

        // Jika creating new user
        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        // Jika updating user
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $this->user->id;
            $rules['username'] = 'required|string|max:255|unique:users,username,' . $this->user->id;
        }

        return $rules;
    }
}
