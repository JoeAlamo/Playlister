<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 27/08/2015
 * Time: 15:37
 */

namespace Playlister\Core\Auth;


use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Laravel\Socialite\Contracts\User as YoutubeUser;
use Playlister\Http\Delegates\Auth\AuthDelegate;
use Laravel\Socialite\Contracts\Provider;
use Playlister\Models\User;
use Playlister\Repositories\User\UserRepository;

class AuthService
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var Guard
     */
    private $auth;
    /**
     * @var Request
     */
    private $request;

    public function __construct(UserRepository $userRepository, Guard $auth, Request $request)
    {
        $this->userRepository = $userRepository;
        $this->auth = $auth;
        $this->request = $request;
    }

    public function registerOrLogin(Provider $socialite, AuthDelegate $delegate)
    {
        // Attempt to get YouTube user using code->accessToken->user
        $youtubeUser = $socialite->user();
        // If user exists, log them in.
        if ($this->userRepository->existsByYoutubeId($youtubeUser->getId())) {
            $user = $this->userRepository->getByYoutubeId($youtubeUser->getId());
            $this->login($youtubeUser, $user);

            return $delegate->userLoggedIn();
        }

        // No user found, let's register them.
        $user = $this->register($youtubeUser);
        $this->login($youtubeUser, $user);

        return $delegate->userJustRegistered();
    }

    protected function register(YoutubeUser $youtubeUser)
    {
        return $this->userRepository->create($youtubeUser);
    }

    private function login(YoutubeUser $youtubeUser, User $user)
    {
        // Log user in
        $this->auth->login($user);
        // Populate users session
        $this->populateSession($youtubeUser);
    }

    private function populateSession(YoutubeUser $youtubeUser)
    {
        $session = $this->request->session();
        $userSessionValues = [
            'youtube_id' => $youtubeUser->getId(),
            'name' => $youtubeUser->getNickname(),
            'avatar' => $youtubeUser->getAvatar(),
            'token' => $youtubeUser->token
        ];
        $session->put('user', $userSessionValues);
    }
}
