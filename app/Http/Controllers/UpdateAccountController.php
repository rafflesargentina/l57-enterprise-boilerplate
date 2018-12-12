<?php

namespace Raffles\Http\Controllers;

use Raffles\Http\Requests\AccountRequest;
use Raffles\Repositories\UserRepository;

use RafflesArgentina\ResourceController\Traits\FormatsValidJsonResponses;

class UpdateAccountController extends Controller
{
    use FormatsValidJsonResponses;

    /**
     * Update the account for the authenticated user.
     *
     * @param AccountRequest $request    The AccountRequest object.
     * @param UserRepository $repository The UserRepository object.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(AccountRequest $request, UserRepository $repository)
    {
        $user = $request->user();

        $repository->update($user, $request->all());

        return $this->validSuccessJsonResponse('Success', ['user' => $user->refresh()]);
    }
}
