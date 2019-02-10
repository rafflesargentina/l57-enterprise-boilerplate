<?php

namespace Raffles\Modules\Dashboard\Http\Controllers;

use Raffles\Modules\Dashboard\Repositories\UserTrafficRepository;

use RafflesArgentina\ResourceController\ApiResourceController;

class UserTrafficController extends ApiResourceController
{
    protected $repository = UserTrafficRepository::class;

    protected $resourceName = 'user-traffic';

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
