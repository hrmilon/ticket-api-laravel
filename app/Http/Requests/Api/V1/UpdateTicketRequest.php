<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends BaseTicketRequest
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
            'data.attributes.title' => 'sometimes|string',
            'data.attributes.description' => 'sometimes|string',
            'data.attributes.status' => 'sometimes|in:A,C,H,X',
            'data.relationships.author.id' => 'prohibited' //user dont need author id to update
        ];

        //for manager
        if($this->user()->tokenCan(Abilities::UpdateTicket)){
            $rules = ['data.relationships.author.id' => 'sometimes|string'];
        }

        return $rules;
    }
}
