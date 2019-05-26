<?php

namespace Raffles\Models;

use Raffles\Models\Traits\UserTrait;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, ShinobiTrait, SoftDeletes, UserTrait;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'name'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'first_name', 'last_name', 'password', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = 'avatar';

    /**
     * Get the user's address.
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * Get the user's addresses.
     */
    public function addresses()
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    /**
     * Get the user's companies.
     */
    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Get the user's contact.
     */
    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable');
    }

    /**
     * Get the user's contacts.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get the user's avatar.
     */
    public function avatar()
    {
        return $this->morphOne(FeaturedPhoto::class, 'photoable')->withDefault();
    }

    /**
     * Get the user's featured address.
     */
    public function featured_address()
    {
        return $this->morphOne(FeaturedAddress::class, 'addressable');
    }

    /**
     * Get the user's photos.
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Get the social login profile record associated with the user.
     */
    public function socialLoginProfile()
    {
        return $this->hasOne(SocialLoginProfile::class);
    }

    /**
     * Get the user's unfeatured address.
     */
    public function unfeatured_address()
    {
        return $this->morphOne(UnfeaturedAddress::class, 'addressable');
    }
}
