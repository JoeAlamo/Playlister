<?php
/**
 * Created by PhpStorm.
 * User: Joe Alamo
 * Date: 27/08/2015
 * Time: 16:03
 */

namespace Playlister\Repositories;


use Illuminate\Database\Eloquent\Model;

abstract class EloquentRepository
{
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @desc Create instance of model by passing fillable attributes
     * @param $input
     * @return Model
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * @desc Get all instances of model
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @desc Get specific instance of model by primary key
     * @param $id
     * @return Model|null
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * @desc Return whether model exists with primary key of $id
     * @param $id
     * @return bool
     */
    public function exists($id)
    {
        return $this->model->where($this->model->getKeyName(), $id)->count() > 0;
    }
} 