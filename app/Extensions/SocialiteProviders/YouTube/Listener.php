<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 24/08/2015
 * Time: 23:05
 */

namespace Playlister\Extensions\SocialiteProviders\YouTube;

use SocialiteProviders\Manager\SocialiteWasCalled;

class Listener {
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('youtube', 'Playlister\Extensions\SocialiteProviders\YouTube\Provider');
    }
} 