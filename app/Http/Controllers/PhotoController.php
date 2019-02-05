<?php

namespace Raffles\Http\Controllers;

use Raffles\Repositories\PhotoRepository;

use DB;
use Illuminate\Http\Request;
use RafflesArgentina\ResourceController\ApiResourceController;
use RafflesArgentina\ResourceController\Exceptions\ResourceControllerException;
use Storage;

class PhotoController extends ApiResourceController
{
    protected $repository = PhotoRepository::class;

    protected $resourceName = 'photos';

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request The request object.
     * @param string  $key     The model key.
     *
     * @throws ResourceControllerException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $key)
    {
        $this->getFormRequestInstance();

        $model = $this->findFirstByKey($key);

        if (!$model) {
            return $this->validNotFoundJsonResponse();
        }

        $location = $model->{$this->getLocationColumn()};
        if (Storage::exists($location)) {
            Storage::delete($location);
        }

        DB::beginTransaction();

        try {
            $this->repository->delete($model);
        } catch (\Exception $e) {
            DB::rollback();

            $message = $this->destroyFailedMessage($key, $e->getMessage());
            throw new ResourceControllerException($message);
        }

        DB::commit();

        $message = $this->destroySuccessfulMessage($key);
        $data = [$model];

        return $this->validSuccessJsonResponse($message, $data);
    }
}
