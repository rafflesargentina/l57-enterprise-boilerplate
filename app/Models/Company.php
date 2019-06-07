<?php

namespace Raffles\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'companyable_id',
        'companyable_type',
        'description',
        'name',
        'slug',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = 'featured_photo';

    /**
     * Get the company's address.
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * Get the company's addresses.
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Get the company's contact.
     */
    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    /**
     * Get the company's featured address.
     */
    public function featured_address()
    {
        return $this->morphOne(FeaturedAddress::class, 'addressable');
    }

    /**
     * Get the company's featured photo.
     */
    public function featured_photo()
    {
        return $this->morphOne(FeaturedPhoto::class, 'photoable')->withDefault();
    }

    /**
     * Get all of the owning companyable models.
     */
    public function companyable()
    {
        return $this->morphTo();
    }

    /**
     * Get the company's map.
     */
    public function map()
    {
        return $this->morphOne(Map::class, 'mapable');
    }

    /**
     * Get the company's photos.
     */
    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    /**
     * Get the company's unfeatured address.
     */
    public function unfeatured_address()
    {
        return $this->morphOne(UnfeaturedAddress::class, 'addressable');
    }

    /**
     * Get the company's unfeatured photos.
     */
    public function unfeatured_photos()
    {
        return $this->morphMany(UnfeaturedPhoto::class, 'photoable');
    }
}
