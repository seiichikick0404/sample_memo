<?php

namespace App\Http\Requests\FolderRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class FolderUpdateRequest extends FormRequest
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
            'folder_id' => 'required',
            'folder_name' => 'required|max:30',
        ];

    }
}
