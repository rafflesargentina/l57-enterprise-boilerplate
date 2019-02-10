<?php

namespace Raffles\Modules\Dashboard\Models;

use Raffles\Modules\Dashboard\Filters\UserTrafficFilters;
use Raffles\Modules\Dashboard\Sorters\UserTrafficSorters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use RafflesArgentina\FilterableSortable\FilterableSortableTrait;

class UserTraffic extends Model
{
    use FilterableSortableTrait, SoftDeletes;

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
        'browser',
        'country_code',
        'country_name',
        'device',
        'device_type',
        'platform',
        'robot_name',
        'token',
        'user_id',
    ];

    /**
     * The query filters associated class.
     *
     * @var mixed
     */
    protected $filters = UserTrafficFilters::class;

    /**
     * The query sorters associated class.
     *
     * @var mixed
     */
    protected $sorters = UserTrafficSorters::class;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_traffic';
}
