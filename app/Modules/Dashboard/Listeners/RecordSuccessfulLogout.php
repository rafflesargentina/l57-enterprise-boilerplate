<?php

namespace Raffles\Modules\Dashboard\Listeners;

use Raffles\Modules\Dashboard\Repositories\UserTrafficRepository;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class RecordSuccessfulLogout implements ShouldQueue
{
    /**
     * The request object.
     *
     * @var Request $request
     */
    protected $request;

    /**
     * The UserTraffic repository.
     *
     * @var $repository
     */
    protected $repository;

    /**
     * Create the event listener.
     *
     * @param Request               $request    The request object.
     * @param UserTrafficRepository $repository The UserTraffic repository.
     */
    public function __construct(Request $request, UserTrafficRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;
        $session = $this->repository->findBy('token', $this->request->session()->get('_token'));

        if ($session) {
            $session->delete();
            $session->save();
        }

        \Log::info('User with ID '.$user->id.' has logged out.');
    }
}
