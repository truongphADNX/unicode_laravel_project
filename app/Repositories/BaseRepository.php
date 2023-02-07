<?php

namespace App\Repositories;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct(){
        $this->setModel();
    }

    public function setModel(){
        $this->model = app()->make($this->getModel());
    }

    abstract public function getModel();

    public function getAll(){
        return $this->model->all();
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function create($attribute = []){
        return $this->model->create($attribute);
    }

    public function update($id, $attributes = []){
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    public function delete($id){
        $result = $this->model->find($id);
        if($result){
            $result->delete();
            return true;
        }
        return false;
    }
}
