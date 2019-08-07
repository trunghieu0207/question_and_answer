<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Answer;
class AnswerRequest extends FormRequest
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
            'content' => 'required',
            'id' => function ($attribute, $value, $fail) {
                    $answer = Answer::find($value);
                    $idUser = Auth::user()->id;
                    if ($answer->user->_id != $idUser) {
                        return $fail('The ' . $attribute . ' not invalid');
                    }
                }
        ];
    }

    public function messages() {

        return [
            'content.required' => 'Please enter answer content'
        ];
    }
}
