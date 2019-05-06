<?php

namespace Raffles\Models;

use Raffles\Models\Traits\AddressTrait;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use AddressTrait;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'location',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'addressable_id',
        'addressable_type',
        'country',
        'door_number',
        'featured',
        'floor_number',
        'locality',
        'state',
        'street_name',
        'street_number',
        'sublocality',
        'zip',
    ];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'addresses';


    /**
     * Get all of the owning addressable models.
     */
    public function addressable()
    {
        return $this->morphTo();
    }
}
