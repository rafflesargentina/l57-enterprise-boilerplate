<?php

namespace Raffles\Http\Controllers\Auth;

use Raffles\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use RafflesArgentina\ResourceController\Traits\FormatsValidJsonResponses;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use FormatsValidJsonResponses, RedirectsUsers, SendsPasswordResetEmails;

    /**
     * Where to redirect users after requesting their password reset.
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
        $this->middleware('guest');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string                   $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        if (request()->wantsJson()) {
            return $this->validSuccessJsonResponse(trans($response), [], $this->redirectPath());
        }

        return back()->with('status', trans($response));
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string                   $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            $errors = new \Illuminate\Support\MessageBag(['email' => trans($response)]);
            return $this->validUnprocessableEntityJsonResponse($errors);
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}
