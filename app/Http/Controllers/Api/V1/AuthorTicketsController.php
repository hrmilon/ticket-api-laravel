<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\v1\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Filters\V1\TicketFilter;
use App\Http\Requests\Api\V1\ReplaceTicketRequest;
use App\Http\Requests\Api\V1\StoreTicketRequest;
use App\Http\Requests\Api\V1\UpdateTicketRequest;
use App\Http\Resources\V1\TicketResource;
use App\Models\Ticket;
use App\Policies\V1\TicketPolicy;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AuthorTicketsController extends ApiController
{

    protected $policyClass = TicketPolicy::class;

    /**
     * Display a listing of the resource.
     */
    public function index($author_id, TicketFilter $filters)
    {
        return TicketResource::collection(
            Ticket::where('user_id', $author_id)
                ->filter($filters)
                ->paginate()
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request, $user_id)
    {

        try {
            //policy
            $this->isAble('store', Ticket::class);
            //todo:: create new ticket
            return new TicketResource(Ticket::create($request->mappedAttributes([
                'author' => 'user_id'
            ])));
        } catch (AuthorizationException $error) {
            return $this->error("you're not authorized to update the resource", 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($author_id, $ticket_id)
    {
        try {
            $ticket = Ticket::where('id', $ticket_id)
                ->where('user_id', $author_id)
                ->firstOrFail();

            return new TicketResource($ticket);

        } catch (ModelNotFoundException $th) {
            return $this->ok("Ticket doesn't exist", 400);
        } catch (AuthorizationException $error) {
            return $this->error("you're not authorized to do it", 200);
        }
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateTicketRequest $request, $author_id, $ticket_id)
    {
        try {
            $ticket = Ticket::where('id', $ticket_id)
                ->where('user_id', $author_id)
                ->firstOrFail();
            //policy
            $this->isAble('update', $ticket);

            $ticket->update($request->mappedAttributes());

            return new TicketResource($ticket);
        } catch (ModelNotFoundException $th) {
            return $this->ok("Ticket doesn't exist", 400);
        } catch (AuthorizationException $error) {
            return $this->error("you're not authorized to do it", 200);
        }
    }



    public function replace(ReplaceTicketRequest $request, $author_id, $ticket_id)
    {
        try {
            $ticket = Ticket::where('id', $ticket_id)
                ->where('user_id', $author_id)
                ->firstOrFail();

            //policy
            $this->isAble('replace', $ticket);

            $ticket->update($request->mappedAttributes());
            return new TicketResource($ticket);
        } catch (ModelNotFoundException $th) {
            return $this->ok("Ticket doesn't exist", 400);
        } catch (AuthorizationException $error) {
            return $this->error("you're not authorized to do it", 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($author_id, $ticket_id)
    {
        try {
            $ticket = Ticket::where('id', $ticket_id)
                ->where('user_id', $author_id)
                ->firstOrFail();
            //policy
            $this->isAble('delete', $ticket);

            $ticket->delete();
            return $this->ok('Successfully deleted');

            return $this->error('Ticket cannot be found', 404);
        } catch (ModelNotFoundException $th) {
            return $this->error('Ticket cannot found', 404);
        } catch (AuthorizationException $error) {
            return $this->error("you're not authorized to do it", 200);
        }
    }
}
