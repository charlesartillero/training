<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
        $rules = [
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.status' => 'required|string|in:A,C,H,X',
        ];

        if ($this->routeIs('tickets.store') && $this->user()->is_manager ){
            $rules['data.relationships.author.data.id'] = 'required|integer|exists:users,id';
        }


        return $rules;

    }

    public function messages() {

        return [
            "data.relationships.author.data.id.exists" => "The user id does not exist.",
            "data.attributes.status.in" => "The status is invalid, please use A, C, H, X."
        ];

    }
}
