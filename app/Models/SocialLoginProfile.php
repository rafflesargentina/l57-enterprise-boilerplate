<?php

namespace Raffles\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLoginProfile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'github_id',
        'google_id',
        'twitter_id',
        'facebook_id',
        'linkedin_id',
    ];

    /**
     * Get the user that owns the social login profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
