<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z-ء-ي, ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z-ء-ي, ]+$/u',
                'mobile' => ['required','digits:11','unique:users' ],
                'email' => ['required','string','email','unique:users' ],
                'password' => ['required',Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised() ,'confirmed'],
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'activation' => 'required|numeric|in:0,1',

            ];
        }else{
            return [
                'first_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z-ء-ي, ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یa-zA-Z-ء-ي, ]+$/u',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            ];
        }
    }
}
