<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class ReplaceUserRequest extends BaseUserRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
     return [
            'data.attributes.name' => 'required|string',
            'data.attributes.email' => 'required|string',
            'data.attributes.isManager' => 'required|boolean',
            'data.attributes.password' => 'required|string',

        ];
    }

}
