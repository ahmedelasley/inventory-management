<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseItemsRequest extends FormRequest
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
        $rules = [];

        switch ($this->method) {
            case 'POST': {
                $rules = [
                    'product_id' => 'required|exists:products,id',
                    'quantity' => 'required|numeric|decimal:0,4|gt:0',
                    'cost' => 'required|numeric|decimal:0,4|gt:0',
                    'production_date' => 'nullable|date|before_or_equal:today',
                    'expiration_date' => 'nullable|date|after_or_equal:production_date',
                    // 'notes' => 'nullable|string|max:255',
                ];
                break;
            }
            case 'PUT':
            case 'PATCH': {
                $rules = [
                    'product_id' => 'required|exists:products,id',
                    'quantity' => 'required|numeric|decimal:0,4|gt:0',
                    'cost' => 'required|numeric|decimal:0,4|gt:0',
                    'production_date' => 'required|date|before_or_equal:today',
                    'expiration_date' => 'required|date|after_or_equal:production_date',
                    // 'notes' => 'nullable|string|max:255',
                ];
                break;
            }
            default:
                break;
        }

        if ($this->input('production_date')) {
            $rules['expiration_date'] = 'required|date|after_or_equal:production_date';
        }

        return $rules;

    }
}
