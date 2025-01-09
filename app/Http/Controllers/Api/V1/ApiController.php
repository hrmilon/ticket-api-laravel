<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Policies\V1\TicketPolicy;
use App\Traits\ApiResponses;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ApiController extends Controller
{
    protected $policyClass;
    use ApiResponses;

    //check if query parameter author exist in the url
    public function include($relationship): bool
    {
        $params = request()->get('include'); //if include keyword persist
        if (!isset($params)) {
            return false;
        }

        $includeValues = explode(',', strtolower($params)); //0=>author
        return in_array(strtolower($relationship), $includeValues);
    }

    public function isAble($ability, $targetModel)
    {
        try {
            $this->authorize($ability, [$targetModel, $this->policyClass]);
            return true;
        } catch (AuthenticationException $th) {
            return false;
        }
    }
}
