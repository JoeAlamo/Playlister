<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 27/08/2015
 * Time: 16:29
 */

namespace Playlister\Repositories\User;


use Playlister\Models\User;
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