<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 24/08/2015
 * Time: 16:48
 */

namespace Playlister\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class HomeRoutes {
    /**
     * Define the home routes.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     */
    public function map(Registrar $router)
    {
        $router->get('/', function () {
            return view('welcome');
        });
    }
}
