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
        'lat',
        'lng',
        'locality',
        'state',
        'street_name',
        'street_number',
        'sublocality',
        'zip',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = 'map';

    /**
     * Get all of the owning addressable models.
     */
    public function addressable()
    {
        return $this->morphTo();
    }

    /**
     * Get the address's map.
     */
    public function map()
    {
        return $this->morphOne(Map::class, 'mapable');
    }
}
