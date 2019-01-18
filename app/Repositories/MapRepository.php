<?php

namespace Raffles\Repositories;

use Raffles\Models\Map;

use Caffeinated\Repository\Repositories\EloquentRepository;

class MapRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    public $model = Map::class;

    /**
     * @var array
     */
    public $tag = ['Map'];
}
