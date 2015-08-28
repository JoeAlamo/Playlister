<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 27/08/2015
 * Time: 16:25
 */

namespace Playlister\Repositories\User;


interface UserRepository
{
    /**
     * @desc Create instance of entity
     * @param $input
     * @return mixed
     */
    public function create($input);

    /**
     * @desc Get all instances of entity
     * @return mixed
     */
    public function getAll();

    /**
     * @desc Get specific instance of entity by primary key
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @desc Get user by youtube id
     * @param $youtubeId
     * @return mixed
     */
    public function getByYoutubeId($youtubeId);

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
