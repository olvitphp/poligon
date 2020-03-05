<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BlogCategoryRepository
 * @package App\Repositories
 */


abstract class BlogCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        // TODO: Implement getModelClass() method.
        return Model::class;
    }

    /**
     * Получить модель для редактирования в админке
     *
     * @param $id
     * @return Model
     */

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     * Получить список категорий для вівода в віпадающем списке
     * @return Collection
     */

    public function getForComboBox()
    {
      //  return $this->startConditions()->all();

        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS id_title',
        ]);
        $result[] = $this->startConditions()->all();
        $result[] = $this
            ->startConditions()
            ->select('blog.categories:*',
           \DB::raw ( 'CONCAT (id, ". ", title) AS id_title'))
       // ->toBase()
        ->get();

        $result[] = $this
            ->startConditions()
            ->selectRaw($columns)
           // ->toBase()
            ->get();

        dd($result);

        return $result;
    }

    /**
     * @param null $perPage
     * @return
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];
        $result =  $this
            ->startConditions()
            ->select($columns)

            ->paginate($perPage);
        dd($result);
        return $result;
    }





}
