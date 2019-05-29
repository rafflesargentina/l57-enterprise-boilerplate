<?php

namespace Raffles\Http\Controllers\Auth;

use Raffles\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use RafflesArgentina\ResourceController\Traits\FormatsValidJsonResponses;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, FormatsValidJsonResponses;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
        $this->middleware('guest')->except('logout');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        if ($request->wantsJson()) {
            try {
                $user = $request->user();
                $user->load('permissions', 'roles');
                $token = $user->createToken(env('APP_NAME'));
                $accessToken = $token->accessToken;
            } catch (\Exception $e) {
                return $this->validInternalServerErrorJsonResponse($e, $e->getMessage());
            }

            $data = [
                'token' => $accessToken,
                'remember' => $request->remember,
                'user' => $user
            ];

            return $this->authenticated($request, $request->user())
                    ?:  $this->validSuccessJsonResponse('Success', $data, $this->redirectPath());
        }

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        if ($request->wantsJson()) {
            $user = $request->user();
            $user->token()->revoke();
            $request->session()->invalidate();
            event(new Logout('api', $user));
            return $this->loggedOut($request) ?: $this->validSuccessJsonResponse('Success', [], $this->redirectPath());
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
