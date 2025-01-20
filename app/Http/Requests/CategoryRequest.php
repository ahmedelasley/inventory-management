<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:categories,name',
            'description' => 'required|string|min:3',
            'parent_id' => 'nullable|exists:categories,id',
        ];

        // switch ($this->method()) {
        //     case 'POST': {
        //         return [
        //             'name' => 'required|string|max:255|unique:categories,name',
        //             'description' => 'nullable',
        //             'parent_id' => 'nullable|exists:categories,id',
        //         ];
        //     }
        //     case 'PUT':
        //     case 'PATCH': {
        //         return [
        //             'name' => 'required|string|max:255|unique:categories,name,' . $this->category->id,
        //             'description' => 'nullable',
        //             'parent_id' => 'nullable|exists:categories,id|not_in:' . $this->category->id, // Prevent circular references
        
        //         ]; 
        //     }
        //     default:
        //         break;
        // }
    }
}
