<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required','max:255','regex:/^[^@#]{5,}$/'],
            'subtitle' => ['required','max:255','regex:/^[^@#]{5,}$/'],
            'ckeditor' => ['required'],
            'img' => ['image','mimes:jpg,png,jpeg,bmp,gif,svg,webp'],
        ];
    }
}
