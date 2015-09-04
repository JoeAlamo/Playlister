<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 27/08/2015
 * Time: 15:47
 */

namespace Playlister\Http\Delegates\Auth;


interface AuthDelegate
{
    public function userJustRegistered();
    public function userLoggedIn();
    public function userLoggedOut();
} 