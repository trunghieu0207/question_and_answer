<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:5|max:30',
            'confirm' => 'required',
            'fullname' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

     public function messages(){

        return [
            'email.required' => 'Please enter email',
            'email.email' => 'This is not an email',
            'password.required' => 'Please  enter password',
            'password.min' => 'Password must be more than 5 characters',
            'password.max' => 'Password must be less than 5 characters',
            'confirm.required' => 'Please confirm the password',
            'fullname.required' => 'Please enter full name',
            'g-recaptcha-response.required' => 'Please check captcha',
            'g-recaptcha-response.captcha' => 'Please check captcha'
        ];
    }
}
