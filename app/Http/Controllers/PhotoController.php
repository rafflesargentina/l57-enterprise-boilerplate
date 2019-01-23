<?php

namespace Raffles\Http\Controllers;

use Raffles\Repositories\PhotoRepository;

use RafflesArgentina\ResourceController\ApiResourceController;

class PhotoController extends ApiResourceController
{
    protected $repository = PhotoRepository::class;

    protected $resourceName = 'photos';
}
