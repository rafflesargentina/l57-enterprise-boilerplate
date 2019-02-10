<?php

namespace Raffles\Modules\Dashboard\Repositories;

use Raffles\Modules\Dashboard\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * @var Model
     */
    public $model = User::class;

    /**
     * @var array
     */
    public $tag = ['User'];
}
