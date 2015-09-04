<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 27/08/2015
 * Time: 16:31
 */

namespace Playlister\Providers;


use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * @desc Register all repository interface to concrete bindings here
     */
    public function register()
    {
        $this->app->bind('Playlister\Repositories\User\UserRepository', 'Playlister\Repositories\User\EloquentUserRepository');
    }
} 