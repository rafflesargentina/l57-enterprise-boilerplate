<?php

namespace Raffles\Modules\Dashboard\Listeners;

use Raffles\Modules\Dashboard\Repositories\UserTrafficRepository;

use Illuminate\Http\Request;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Jenssegers\Agent\Agent;
use IP2LocationLaravel;    

class RecordSuccessfulLogin implements ShouldQueue
{
    /**
     * The request object.
     *
     * @var Request $request
     */
    protected $request;

    /**
     * The Agent object.
     *
     * @var object $agent
     */
    protected $agent;

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
     * @param Agent                 $agent      The agent object.
     * @param UserTrafficRepository $repository The UserTraffic repository.
     *
     * @return void
     */
    public function __construct(Request $request, Agent $agent, UserTrafficRepository $repository)
    {
        $this->request = $request;
        $this->agent = $agent;
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
        $browser = $this->agent->browser();
        $device = $this->agent->device();
        $deviceType = null;
        $ip = $this->request->ip();
        $platform = $this->agent->platform();
        $robot = $this->agent->robot();

        if ($this->agent->isDesktop()) {
            $deviceType = "Desktop";
        }

        if ($this->agent->isPhone()) {
            $deviceType = "Móvil";
        }

        if ($this->agent->isRobot()) {
            $deviceType = "Robot";
        }

        if ($this->agent->isTablet()) {
            $deviceType = "Tablet";
        }

        $records = IP2LocationLaravel::get($ip);
        $countryCode = $records['countryCode'];
        $countryName = $records['countryName'];

        $user = $event->user;
        $this->repository->create(
            [
            'browser' => $browser,
            'country_code' => $countryCode,
            'country_name' => $countryName,
            'device' => $device,
            'device_type' => $deviceType,
            'ip_address' => $ip,
            'platform' => $platform,
            'robot_name' => $robot,
            'token' => $this->request->session()->get('_token'),
            'user_id' => $user->id
            ]
        );

        \Log::info('User with ID '.$user->id.' has logged in.');
    }
}
