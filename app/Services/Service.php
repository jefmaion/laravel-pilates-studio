<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class Service {

    protected $model;

    protected $hasError = false;
    protected $error = '';

    public function __construct(Model $model = null)
    {
        $this->model = $model;
    }

    public function setErrorMessage($message) {
        $this->error = $message;
        $this->hasError = true;
    }

    public function hasError() {
        return $this->hasError;
    }

    public function getErrorMessage() {
        return $this->error;
    }

    public function find($id) {
        return $this->model->find($id);
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function update(Model $model, $data) {
        return $model->fill($data)->update();
    }

    public function delete(Model $model) {
        return $model->delete();
    }

    public function latest() {
        return $this->model->latest()->get();
    }

    public function all() {
        return $this->model->all();
    }

    public function countAll() {
        return $this->model->count();
    }

    

}