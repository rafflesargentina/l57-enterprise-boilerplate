<?php

namespace Raffles\Modules\Dashboard\Http\Controllers;

class UserActiveController extends UserController
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        return $this->validSuccessJsonResponse("Success", $this->getItemsCollection());
    }

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
        return [
            'Activos' => $this->repository->getCount()->pluck('count')[0],
            'Inactivos' => $this->repository->getOnlyTrashedCount()->pluck('count')[0]
        ];
    }
}
