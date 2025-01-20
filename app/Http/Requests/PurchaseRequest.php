<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseRequest extends FormRequest
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
                    'warehouse_id' => 'required|exists:warehouses,id',
                    'supplier_id' => 'required|exists:suppliers,id',

                    // 'name' => 'required|string|min:3||max:255|unique:products,name',
                    // 'name_localized' => 'nullable|string|min:3|max:255',
                    // 'description' => 'nullable|string|min:3|max:255',
                    // // 'sku' => 'required|string|max:14|unique:products,sku',
                    // 'storge_unit' => 'required|string|max:255',
                    // 'intgredtiant_unit' => 'required|string|max:255',
                    // 'storage_to_intgredient' => 'required|string|max:255',
                    // 'costing_method' => 'required|in:Fixed,From Transactions',
                    // 'category_id' => 'required|exists:categories,id',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'warehouse_id' => 'required|exists:warehouses,id',
                    'supplier_id' => 'required|exists:suppliers,id',


                    // 'name' => ['required', 'string', 'min:3', 'max:255' , Rule::unique('products')->ignore($this->id)] ,
                    // 'name_localized' => 'nullable|string|min:3|max:255',
                    // 'description' => 'nullable|string|min:3|max:255',
                    // // 'sku' => ['required', 'string', 'max:14' , Rule::unique('products')->ignore($this->id)] ,
                    // 'storge_unit' => 'required|string|max:255',
                    // 'intgredtiant_unit' => 'required|string|max:255',
                    // 'storage_to_intgredient' => 'required|string|max:255',
                    // 'costing_method' => 'required|in:Fixed,From Transactions',
                    // 'category_id' => 'required|exists:categories,id',
                ];
            }
            default:
                break;
        }
    }
}
