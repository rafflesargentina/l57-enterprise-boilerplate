<?php

namespace Raffles\Modules\Dashboard\Http\Controllers;

use Raffles\Modules\Dashboard\Repositories\UserRepository;

use RafflesArgentina\ResourceController\ApiResourceController;

class UserController extends ApiResourceController
{
    protected $repository = UserRepository::class;

    protected $resourceName = 'users';

    protected $useSoftDeletes = true;

    /**
     * Get items collection.
     *
     * @param string $orderBy The order key.
     * @param string $order   The order direction.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItemsCollection($orderBy = 'updated_at', $order = 'desc')
    {
        return $this->repository->findAll();
    }
}
