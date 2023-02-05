<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $name
 * @property mixed $cover_image
 */
class AddPhotoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'description' => 'required|string|min:10',
            'name' => 'required|string|min:2',
            'image' => 'required|image|mimes:jpg,png'
        ];
    }
}