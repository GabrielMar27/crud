<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }


    public function rules(): array
    {
        return [
            'id'=>'required|BigInt|min:1|max:10000|unique:post,code',
            'title'=>'required|string|max:250',
            'description'=>'required|string|max:1000',
            'image'=>'required|mimes:pdf,jpg,png',
            'create_at'=>'required',
            'update_at'=>'nullable|required',
        ];
    }
}
