<?php

namespace Raffles\Repositories;

use Raffles\Models\Address;

use Caffeinated\Repository\Repositories\EloquentRepository;

class AddressRepository extends EloquentRepository
{
    /**
     * @var Model
     */
    public $model = Address::class;

    /**
     * @var array
     */
    public $tag = ['Address'];
}
