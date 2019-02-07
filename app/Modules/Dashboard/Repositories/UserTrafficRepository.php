<?php

namespace Raffles\Modules\Dashboard\Repositories;

use Raffles\Modules\Dashboard\Models\UserTraffic;

class UserTrafficRepository extends BaseRepository
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
