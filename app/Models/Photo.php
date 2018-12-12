<?php

namespace Raffles\Models;

use Raffles\Models\Traits\PhotoTrait;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use PhotoTrait;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'size',
        'url',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'featured',
        'location',
        'name',
        'photoable_id',
        'photoable_type',
        'slug'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
     * Get all of the owning photoable models.
     */
    public function photoable()
    {
        return $this->morphTo();
    }
}
