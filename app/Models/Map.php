<?php

namespace Raffles\Models;

use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'zoom' => '14',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'lat' => 'float',
        'lng' => 'float',
        'zoom' => 'int'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lat',
        'lng',
        'mapable_id',
        'mapable_type',
        'zoom',
    ];

    /**
     * Get all of the owning mapable models.
     */
    public function mapable()
    {
        return $this->morphTo();
    }
}
