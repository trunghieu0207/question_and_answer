<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTopicRequest extends FormRequest
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

            'title' => 'required|max:255',
            'content' => 'required',
        ];
    }

    public function messages() {
        
        return [
            'title.required' => 'Please enter a title.',
            'title.max' => 'The title is up to 255 characters.',
            'content.required' => 'Please enter a content.'
        ];
    }
}
