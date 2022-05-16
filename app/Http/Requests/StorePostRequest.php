<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', Post::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category' => 'exists:categories,id',
            'title' => 'required|string|min:2|max:64',
            'content' => 'required|string|min:2|max:1024',
            'image' => 'file|mimetypes:image/jpg,image/png',
        ];
    }
}
