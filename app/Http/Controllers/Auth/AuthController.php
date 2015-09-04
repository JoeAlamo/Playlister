<?php

namespace Playlister\Http\Controllers\Auth;

use Illuminate\Routing\Redirector;
use Laravel\Socialite\Contracts\Factory;
use Playlister\Core\Auth\AuthService;
use Playlister\Http\Delegates\Auth\AuthDelegate;
use Playlister\Http\Controllers\Controller;

class AuthController extends Controller implements AuthDelegate
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller facilitates logging in via YouTube using OAuth2.
    | For first time logins, we will create a user entity in our database.
    |
    */

    /**
     * @var \Laravel\Socialite\Contracts\Provider
     */
    private $socialite;
    /**
     * @var Redirector
     */
    private $redirector;

    public function __construct(Factory $socialite, Redirector $redirector)
    {
        $this->socialite = $socialite->driver('youtube');
        $this->redirector = $redirector;
    }

    public function showLogin()
    {
        return $this->socialite->redirect();
    }

    public function postLogin(AuthService $authService)
    {
        try {
            // Either register or log user in
            return $authService->registerOrLogin($this, $this->socialite);
        } catch (\Exception $e) {
            //@todo Handle "access denied" more cleanly
            return $this->redirector->to('/')
                ->with('alertFail', 'A problem occurred during logging in');
        }
    }

    public function userJustRegistered()
    {
        return $this->redirector->to('/')
            ->with('alertSuccess', "Welcome to Playlister. As this is your first time here, take a moment to read this holding text.");
    }

    public function userLoggedIn()
    {
        return $this->redirector->to('/')
            ->with('alertSuccess', 'Welcome back!');
    }

    public function logoutAction(AuthService $authService)
    {
        return $authService->logout($this);
    }

    public function userLoggedOut()
    {
        return $this->redirector->to('/')
            ->with('alertSuccess', 'You have been successfully logged out.');
    }
}
