<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 27/08/2015
 * Time: 16:25
 */

namespace Playlister\Repositories\User;

use Laravel\Socialite\Contracts\User;

interface UserRepository
{
    /**
     * @desc Create instance of entity
     * @param $input
     * @return mixed
     */
    public function create(User $input);

    /**
     * @desc Get all instances of entity
     * @return mixed
     */
    public function getAll();

    /**
     * @desc Get specific instance of entity
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @desc Find out whether entity exists
     * @param $id
     * @return mixed
     */
    public function exists($id);

    /**
     * @desc Return whether user exists associated to $youtubeId
     * @param $youtubeId
     * @return bool
     */
    public function existsByYoutubeId($youtubeId);
}
