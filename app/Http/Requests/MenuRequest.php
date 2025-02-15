<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends FormRequest
{

    protected $id;
    protected $method;

    public function __construct($method = 'POST', $id = NULL)
    {
        $this->method = $method;
        $this->id = $id;
    }
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

        switch ($this->method) {
            case 'POST': {
                return [
                    'restaurant_id' => 'required|exists:restaurants,id',
                    'kitchen_id' => 'required|exists:kitchens,id',
                    'name' => 'required|string|min:3||max:255|unique:menus,name',
                    'name_localized' => 'nullable|string|min:3|max:255',
                    'description' => 'nullable|string|min:3|max:255',
                    // 'sku' => 'required|string|max:14|unique:products,sku',
                    'price' => 'required|numeric|decimal:0,4|gt:0',
                    'category_id' => 'required|exists:categories,id',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'restaurant_id' => 'required|exists:restaurants,id',
                    'kitchen_id' => 'required|exists:kitchens,id',
                    'name' => ['required', 'string', 'min:3', 'max:255' , Rule::unique('menus')->ignore($this->id)] ,
                    'name_localized' => 'nullable|string|min:3|max:255',
                    'description' => 'nullable|string|min:3|max:255',
                    // 'sku' => ['required', 'string', 'max:14' , Rule::unique('products')->ignore($this->id)] ,
                    'price' => 'required|numeric|decimal:0,4|gt:0',
                    'category_id' => 'required|exists:categories,id',
                ];
            }
            default:
                break;
        }
    }
}
