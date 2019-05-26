<?php

namespace Raffles\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contactable_id',
        'contactable_type',
        'email',
        'fax',
        'mobile',
        'phone',
        'position',
        'website',
    ];

    /**
     * Get all of the owning contactable models.
     */
    public function contactable()
    {
        return $this->morphTo();
    }
}
