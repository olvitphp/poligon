<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
 use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CoreRepository.
 * @package App\Repositories
 */
 abstract class CoreRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

      //  return YourModel::class;
        /**
         *  CoreRepository constructor
         */
        public function __construct()
        {
            $this->model = app($this->getModelClass());
        }
        /**
         * @return mixed
         */
        abstract protected function getModelClass();

     /**
      * @return \Illuminate\Contracts\Foundation\Application|mixed
      */
    protected function startConditions()
    {
        return clone $this->model;
    }

}
