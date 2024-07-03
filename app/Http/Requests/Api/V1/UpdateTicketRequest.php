<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTicketRequest extends FormRequest
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
        if ($this->method() === 'PUT') {
            $rules = [
                'data.attributes.title' => 'required|string',
                'data.attributes.description' => 'required|string',
                'data.attributes.status' => 'required|string|in:A,C,H,X',
            ];
        } else {
            $rules = [
                'data.attributes.title' => 'sometimes|required|string',
                'data.attributes.description' => 'sometimes|required|string',
                'data.attributes.status' => 'sometimes|required|string|in:A,C,H,X',
            ];
        }


        if ($this->routeIs('tickets.store')) {
            $rules['data.relationships.author.data.id'] = 'required|integer|exists:users,id';
        }


        return $rules;
    }
}
