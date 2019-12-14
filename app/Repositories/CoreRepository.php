<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{

    protected $model;
    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    public function startConditions()
    {
        return clone $this->model;
    }

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }
}
