<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Character extends Model
{
    use HasFactory, SoftDeletes;

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
