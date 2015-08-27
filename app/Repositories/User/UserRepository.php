<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 27/08/2015
 * Time: 16:25
 */

namespace Playlister\Repositories\User;


use Playlister\Repositories\Repository;

interface UserRepository extends Repository
{
    /**
     * @desc Return whether user exists associated to $youtubeId
     * @param $youtubeId
     * @return bool
     */
    public function existsByYoutubeId($youtubeId);
} 