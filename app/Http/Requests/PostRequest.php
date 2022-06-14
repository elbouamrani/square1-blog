<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public static function getRules()
    {
        return [
            'title'             => ['required'],
            'description'       => ['required'],
            'publication_date'  => ['required', 'date'],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return self::getRules();
    }
}
