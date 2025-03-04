<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUploadRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'string|max:255',
             'path' => 'string',
             'type' => 'string',
             'size' => 'string',
             'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'likes' => 'integer',
            'saves' => 'integer',
            'shares' => 'integer',
            'user_id' => 'required|integer'
        ];
    }
}
