<?php

namespace Playlister\Http\Controllers\Auth;

use Illuminate\Routing\Redirector;
use Laravel\Socialite\Contracts\Factory;
use Playlister\Models\User;
use Playlister\Http\Controllers\Controller;

class AuthController extends Controller
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

    public function postLogin()
    {
        try {
            dd($this->socialite->user());
        } catch (\Exception $e) {
            return $this->redirector->home()->with('alertFail', 'A problem occurred during logging in');
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
