<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{

    protected $id;
    protected $method;

    public function __construct($method, $id = NULL)
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
                    'name' => 'required|string|min:3|max:255|unique:clients,name',
                    'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:clients,phone',
                    'email' => 'nullable|email',
                    'address' => 'nullable|string|min:3',
                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => ['required', 'string', 'min:3', 'max:255' , Rule::unique('clients')->ignore($this->id)] ,
                    'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', Rule::unique('clients')->ignore($this->id)],
                    'email' => 'nullable|email',
                    'address' => 'nullable|string|min:3',
                ];
            }
            default:
                break;
        }
    }
}
