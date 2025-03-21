<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
         switch ($this->method()) {
            case 'POST': {
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)],
                    'role' => 'required|string|exists:roles,name',

                ];
            }
            case 'PUT':
            case 'PATCH': {
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
                    'role' => 'required|string|exists:roles,name',

                ]; 
            }
            default:
                break;
        }
    }
}
