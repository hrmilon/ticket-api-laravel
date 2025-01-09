<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\v1\ApiController;
use App\Http\Filters\V1\AuthorFilter;
use App\Http\Requests\Api\V1\ReplaceUserRequest;
use App\Models\User;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Resources\V1\UserResource;
use App\Policies\V1\UserPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends ApiController
{

    protected $policyClass = UserPolicy::class;


    /**
     * Display a listing of the resource.
     */
    public function index(AuthorFilter $filters)
    {
        return UserResource::collection(
            User::filter($filters)
                ->paginate()
        );


        /**
            return UserResource::collection(
            User::select('users.*')
                ->join('tickets', 'users_id', '=', 'ticktes.user_id')
                ->filter($filters)
                ->distinct()
                ->paginate()
        );
         */
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {

        try {
            //policy
            $this->isAble('store', User::class);
            //todo:: create new user
            // dd($request->mappedAttributes());
            return new UserResource(User::create($request->mappedAttributes()));
        } catch (AuthorizationException $error) {
            return $this->error("you're not authorized to create the user", 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {
            if ($this->include('tickets')) {
                return new UserResource($user->load('tickets'));
            }
            return new UserResource($user);
        }
         catch (NotFoundHttpException $th) {
            return $this->ok("User doesn't exist", 400);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);

            //policy
            $this->isAble('update', $user);

            $user->update($request->mappedAttributes());

            return new UserResource($user);
        } catch (ModelNotFoundException $th) {
            return $this->ok("User doesn't exist", 400);
        } catch (AuthorizationException $error) {
            return $this->error("you're not authorized to update the user", 400);
        }
    }

    public function replace(ReplaceUserRequest $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $this->isAble('replace', $user);
            $user->update($request->mappedAttributes());
            return new UserResource($user);
        } catch (ModelNotFoundException $th) {
            return $this->ok("User doesn't exist", 400);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            $this->isAble('delete', $user);
            $user->delete();
            return $this->ok('Successfully deleted');
        } catch (ModelNotFoundException $th) {
            return $this->error('User can not be found', 404);
        } catch (AuthorizationException $error) {
            return $this->error("you're not authorized to do it", 200);
        }
    }
}
