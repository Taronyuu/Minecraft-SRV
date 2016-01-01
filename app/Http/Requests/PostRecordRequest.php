<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostRecordRequest extends Request
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
            'name' => 'required|min:2|max:30|unique:records',
            'ip' => 'required|ip',
            'port' => 'required|numeric|min:0|max:65535',
            'email' => 'required|email'
        ];
    }
}
