<?php

namespace App\Http\Requests\MemoRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MemoUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {

        return [
            'edit_id' => 'required',
            'edit_title' => 'required|max:35',
            'edit_content' => 'max:500',
        ];

    }
}
