<?php

namespace Raffles\Http\Controllers;

use Illuminate\Http\Request;

use RafflesArgentina\ResourceController\Traits\FormatsValidJsonResponses;

class AccountController extends Controller
{
    use FormatsValidJsonResponses;

    /**
     * Get the account for the authenticated user.
     *
     * @param Request $request The request object.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        abort_if (!$request->user(), 401);

        return $this->validSuccessJsonResponse('Success', ['user' => $request->user()]);
    }
}
