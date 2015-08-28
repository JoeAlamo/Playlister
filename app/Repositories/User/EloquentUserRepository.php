<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 27/08/2015
 * Time: 16:29
 */

namespace Playlister\Repositories\User;


use Playlister\Models\User;
use Laravel\Socialite\Contracts\User as YoutubeUser;
use Playlister\Repositories\EloquentRepository;

class EloquentUserRepository extends EloquentRepository implements UserRepository
{
    /**
     * @var User
     */
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create($youtubeUser)
    {
        if (!$youtubeUser instanceof YoutubeUser) {
            throw new \InvalidArgumentException('Must be a Socialite user');
        }

        $user = new User();
        $user->name = $youtubeUser->getNickname();
        $user->youtube_id = $youtubeUser->getId();
        $user->save();

        return $user;
    }

    /**
     * @desc Get user by youtube id
     * @param $youtubeId
     * @return mixed
     */
    public function getByYoutubeId($youtubeId)
    {
        return $this->model->where('youtube_id', $youtubeId)->first();
    }

    /**
     * @desc Return whether user exists tied to $youtubeId
     * @param $youtubeId
     * @return bool
     */
    public function existsByYoutubeId($youtubeId)
    {
        return $this->model->where('youtube_id', $youtubeId)->count() > 0;
    }
}
