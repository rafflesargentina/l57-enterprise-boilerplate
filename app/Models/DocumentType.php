<?php

namespace Raffles\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'name',
        'slug',
    ];
}
