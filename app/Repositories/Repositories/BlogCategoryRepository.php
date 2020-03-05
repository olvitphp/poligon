<?php

namespace App\Repositories;

//use Your Model
use App\Models\BlogCategory as Model;
 // use Illuminate\Database\Eloquent\Model;

/**
 * Class BlogCategoryRepository.
 * @package App\Repository
 */
class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected function getModelClass()
    {
        return Model::class;
    }
//    public function model()
//    {
//       // return YourModel::class;
//    }

    /**
     * @param int $id
     * @return mixed
     */

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    public function getForComboBox()
    {
        return $this->startConditions()->all();
    }

//    private function startConditions()
//    {
//    }

}
