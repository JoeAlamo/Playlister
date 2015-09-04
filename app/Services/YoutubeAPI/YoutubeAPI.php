<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 30/08/2015
 * Time: 16:57
 */

namespace Playlister\Services\YoutubeAPI;


interface YoutubeAPI {
    /**
     * @desc Configure settings for client
     * @return void
     */
    public function initializeClient();

    /**
     * @return \Google_Client
     */
    public function getClient();

    /**
     * @desc Set token for client to use
     * @param array $token
     * @return \Google_Client
     */
    public function setToken($token);
} 