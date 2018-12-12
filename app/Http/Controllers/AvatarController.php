<?php

namespace Raffles\Http\Controllers;

use Raffles\Http\Requests\AvatarRequest;
use Raffles\Repositories\UserRepository;

use RafflesArgentina\ResourceController\ApiResourceController;

class AvatarController extends ApiResourceController
{
    protected $formRequest = AvatarRequest::class;

    protected $pruneHasOne = true;

    protected $repository = UserRepository::class;

    protected $resourceName = 'avatars';
}
