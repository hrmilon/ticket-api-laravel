<?php

namespace App\Http\Requests\Api\V1;

use App\Permissions\V1\Abilities;
use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends BaseTicketRequest
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

        $authorIdAttr = $this->routeIs('tickets.store') ? 'data.relationships.author.id' : 'author';

        $user = $this->user();
        $userRule = 'required|integer|exists:users,id';


        //signed in user id if match with id
        $base = [
            'data.attributes.title' => 'required|string',
            'data.attributes.description' => 'required|string',
            'data.attributes.status' => 'required|in:A,C,H,X',
            $authorIdAttr => $userRule . '|size:' .  $user->id
        ];

        //for manager
        if ($user->tokenCan(Abilities::CreateOwnTicket)) {
            $base[$authorIdAttr] = $userRule;
        }
        return $base;
    }


    public function prepareForValidation()
    {
        if ($this->routeIs('authors.tickets.store')) {
            $this->merge([
                'data.relationships.author.id' => $this->route('author')
            ]);
        }
    }
}
