<?php

namespace Raffles\Http\Controllers\Auth;

use Raffles\Models\User;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Laravel\Socialite\Contracts\Factory as Socialite;

class SocialLoginController extends LoginController
{
    /**
     * The Socialite contract.
     *
     * @var Socialite $socialite
     */
    protected $socialite;

    /**
     * The User model.
     *
     * @var User $user
     */
    protected $user;

    /**
     * Create a new SocialLoginController instance.
     *
     * @param Socialite $socialite The Socialite contract.
     * @param User      $user      The User model.
     *
     * @return void
     */
    public function __construct(Socialite $socialite, User $user)
    {
        parent::__construct();

        $this->socialite = $socialite;
        $this->User = $user;
    }

    /**
     * Redirect the user to the specified provider authentication page.
     *
     * @param string $provider The Socialite provider.
     * @param string $scopes   The scopes.
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate($provider, $scopes = null)
    {
        return $this->socialite->driver($provider)
            ->scopes($scopes)
            ->stateless()
            ->redirect();
    }

    /**
     * Handle a social login request to the application.
     *
     * @param Request     $request  The Request object.
     * @param string|null $provider The Socialite provider.
     *
     * @return mixed
     */
    public function login(Request $request)
    {
        return $this->sendLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
            'code' => 'required',
            'state' => 'required',
            ]
        );
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
\Log::info('asdasdasd');
        $provider = $request->provider;
        $socialUser = $this->socialite->driver($provider)->stateless()->user();
        $user = $this->firstOrCreateUser($socialUser);

        $avatar = $this->firstOrCreateAvatar($user, $socialUser);
        $this->updateOrCreateSocialLoginProfile($user, $socialUser,  $provider);

        if ($request->wantsJson()) {
            try {
                $user->load('permissions', 'roles');
                $token = $user->createToken(env('APP_NAME'));
                $accessToken = $token->accessToken;
            } catch (\Exception $e) {
                //return $this->validInternalServerErrorJsonResponse($e, $e->getMessage());
            }

            $data = [
                'token' => $accessToken,
                'remember' => $request->remember,
                'user' => $user
            ];

            return $this->authenticated($request, $request->user())
                    ?:  $this->validSuccessJsonResponse('Success', $data, $this->redirectPath());
        }

        $sessionKey = "{$provider}_token";
        $request->session()->put($sessionKey, $socialUser->token);

        $this->guard('socialite')->login($user);

        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * Get first or create User model.
     *
     * @param mixed $socialUser The Socialite User object.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function firstOrCreateUser($socialUser)
    {
        $user = $this->User->firstOrCreate(
            ['email' => $socialUser->getEmail()],
            [
                'nickname' => $socialUser->getNickname(),
                'first_name' => $socialUser->getName(),
            ]
        );

        if ($user->wasRecentlyCreated) {
            event(new Registered($user));
        }

        return $user;
    }

    /**
     * Get first or create Avatar relation.
     *
     * @param mixed $user       The User model.
     * @param mixed $socialUser The Socialite User object.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function firstOrCreateAvatar($user, $socialUser)
    {
        $data = ['location' => $socialUser->getAvatar()];

        if (!$user->avatar) {
            return $user->avatar()->create($data);
        }

        return $user->avatar()->update($data);
    }

    /**
     * Update or create SocialLoginProfile relation.
     *
     * @param mixed  $user       The User model.
     * @param mixed  $socialUser The Socialite User object.
     * @param string $provider   The Socialite provider.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function updateOrCreateSocialLoginProfile($user, $socialUser, $provider)
    {
        $providerId = "{$provider}_id";

        return $user->socialLoginProfile()->updateOrCreate(
            ['user_id' => $user->id],
            [$providerId => $socialUser->getId()]
        );
    }
}
