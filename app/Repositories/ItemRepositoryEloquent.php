<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ItemRepository;
use App\Models\Item;
use App\Validators\ItemValidator;

/**
 * Class ItemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ItemRepositoryEloquent extends BaseRepository implements ItemRepository
{
    protected $fieldSearchable = [
        'name',
        'categories.name',
        'categories.id'
    ];


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Item::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ItemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
