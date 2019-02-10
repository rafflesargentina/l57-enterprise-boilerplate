<?php

namespace Raffles\Modules\Dashboard\Http\Controllers;

class GeoUsageController extends UserTrafficController
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
        $groupBy = 'country_name';
        return $this->repository->getGroupedCountWithTrashed($groupBy, ['count', $groupBy])->sortByDesc('count')->pluck('count', $groupBy);
    }
}
