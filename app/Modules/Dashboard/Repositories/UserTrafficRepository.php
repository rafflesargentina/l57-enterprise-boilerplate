<?php

namespace Raffles\Modules\Dashboard\Repositories;

use Raffles\Modules\Dashboard\Models\UserTraffic;

use Caffeinated\Repository\Repositories\EloquentRepository;

class UserTrafficRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    public $model = UserTraffic::class;

    /**
     * @var array
     */
    public $tag = ['UserTraffic'];
}
