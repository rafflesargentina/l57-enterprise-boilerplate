<?php

namespace Raffles\Modules\Dashboard\Models;

use Raffles\Models\User as BaseUser;
use Raffles\Modules\Dashboard\Filters\UserFilters;
use Raffles\Modules\Dashboard\Sorters\UserSorters;

use RafflesArgentina\FilterableSortable\FilterableSortableTrait;

class User extends BaseUser
{
    use FilterableSortableTrait;

    /**
     * The query filters associated class.
     *
     * @var mixed
     */
    protected $filters = UserFilters::class;

    /**
     * The query sorters associated class.
     *
     * @var mixed
     */
    protected $sorters = UserSorters::class;
}
