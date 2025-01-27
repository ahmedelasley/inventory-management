<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Kitchen;

use Illuminate\Validation\Rule;

class KitchenRequest extends FormRequest
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
                    'name' => ['required', 'string', 'max:255', Rule::unique(Kitchen::class)],
                    // 'code' => ['required', 'string', 'max:255', Rule::unique(Kitchen::class)],
                    'location' => 'nullable|string|min:3|max:255',
                    'restaurant_id' => 'required|exists:restaurants,id',
                    'supervisor_id' => 'required|exists:supervisors,id',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => ['required', 'string', 'max:255' , Rule::unique(Kitchen::class)->ignore($this->id)] ,
                    // 'code' => ['required', 'string', 'max:255' , Rule::unique(Kitchen::class)->ignore($this->id)] ,
                    'location' => 'nullable|string|min:3|max:255',
                    'restaurant_id' => 'required|exists:restaurants,id',
                    'supervisor_id' => 'required|exists:supervisors,id',
                ];
            }
            default:
                break;
        }
    }
}
