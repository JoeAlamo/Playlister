<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 30/08/2015
 * Time: 16:56
 */

namespace Playlister\Services\YoutubeAPI;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Http\Request;
use Google_Client as Client;

class YoutubeAPIService implements YoutubeAPI
{
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Config
     */
    private $config;
    /**
     * @var Client
     */
    private $client;

    public function __construct(Guard $auth, Request $request, Config $config)
    {
        $this->auth = $auth;
        $this->request = $request;
        $this->config = $config;
        $this->initializeClient();
    }

    public function initializeClient()
    {
        $this->client = new Client();
        $this->client->setAccessType('offline');
        $this->client->setApplicationName('playlister');
        $this->client->setClientId($this->config->get('services.youtube.client_id'));
        $this->client->setClientSecret($this->config->get('services.youtube.client_secret'));
        $this->client->setRedirectUri($this->config->get('services.youtube.redirect'));
        $this->client->setDeveloperKey($this->config->get('services.youtube.api_key'));
        $this->client->addScope('https://www.googleapis.com/auth/youtube.readonly');

        if ($this->auth->check() && $this->request->session()->has('user.token')) {
            $this->setToken($this->request->session()->get('user.token'));
        }
    }

    public function getClient()
    {
        if (!isset($this->client)) {
            $this->initializeClient();
        }

        return $this->client;
    }

    public function setToken($token)
    {
        if (!$this->validateToken($token)) {
            throw new \InvalidArgumentException("Token must be array or traversable and contain all required fields");
        }

        $this->getClient()->setAccessToken(json_encode($token));

        return $this->getClient();
    }

    private function validateToken($token)
    {
        if (!(is_array($token)) && !($token instanceof \Traversable)) {
            return false;
        }

        $requiredFields = [
            'access_token',
            'token_type',
            'expires_in',
            'refresh_token',
            'created',
        ];

        foreach ($requiredFields as $requiredField) {
            if (!array_key_exists($requiredField, $token)) {
                return false;
            }
        }

        return true;
    }
} 