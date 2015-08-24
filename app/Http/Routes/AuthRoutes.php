<?php

namespace Playlister\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class AuthRoutes
{
    /**
     * Define the auth routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->group(['as' => 'auth.', 'namespace' => 'Auth', 'prefix' => 'auth'], function (Registrar $router) {
            // Login routes
            $router->get('login', [
                'middleware' => 'guest',
                'as'         => 'login',
                'uses'       => 'AuthController@showLogin',
            ]);
            $router->post('login', [
                'middleware' => 'guest',
                'as'         => 'login',
                'uses'       => 'AuthController@postLogin',
            ]);
            $router->get('logout', [
                'as'   => 'logout',
                'uses' => 'AuthController@logoutAction',
            ]);
        });
    }
}
