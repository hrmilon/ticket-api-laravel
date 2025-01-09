<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class BaseUserRequest extends FormRequest
{
    public function mappedAttributes(array $otherAttributes = [])
    {
        $mappedAttributes = array_merge([
            'data.attributes.name' => 'name',
            'data.attributes.email' => 'email',
            'data.attributes.isManager' => 'is_manager',
            'data.attributes.password' => 'password'
        ], $otherAttributes);

        $attributesToUpdate = [];
        foreach ($mappedAttributes as $key => $attribute) {
            $value = $this->input($key);
            if ($this->has($key)) {
                if ($attribute === 'password') {
                    $value = bcrypt($value);
                }
                $attributesToUpdate[$attribute] = $this->input($key);
            }
        }
        return $attributesToUpdate;
    }

    public function messages()
    {
        return [
            'data.attributes.email' => 'Email already is used'
        ];
    }
}
