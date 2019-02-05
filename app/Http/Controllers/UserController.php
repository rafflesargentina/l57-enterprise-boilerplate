<?php

namespace Raffles\Http\Controllers;

use Raffles\Repositories\UserRepository;

use RafflesArgentina\ResourceController\ApiResourceController;

class UserController extends ApiResourceController
{
    protected $repository = UserRepository::class;

    protected $resourceName = 'users';
}
