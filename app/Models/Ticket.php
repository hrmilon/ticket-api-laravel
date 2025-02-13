<?php

namespace App\Models;

use App\Http\Filters\V1\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    /** @use HasFactory<\Database\Factories\TicketFactory> */
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'description', 'status'];
    // protected $guarded = [];


    
    public function author()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }


    public function scopeFilter(Builder $builder, QueryFilter $filters){
        return $filters->apply($builder);
    }
}
