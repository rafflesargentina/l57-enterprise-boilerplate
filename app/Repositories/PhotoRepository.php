<?php

namespace Raffles\Repositories;

use Raffles\Models\Photo;

use Caffeinated\Repository\Repositories\EloquentRepository;

class PhotoRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    public $model = Photo::class;

    /**
     * @var array
     */
    public $tag = ['Photo'];
}
