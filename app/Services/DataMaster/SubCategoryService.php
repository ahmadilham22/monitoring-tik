<?php

namespace App\Services\DataMaster;

use App\Repositories\DataMaster\SubCategoryRepository;

class SubCategoryService
{
    protected $subCategory;

    public function __construct(SubCategoryRepository $subCategory)
    {
        $this->subCategory = $subCategory;
    }

    public function getAll()
    {
        return $this->subCategory->getAll();
    }

    public function createCategory($data)
    {
        return $this->subCategory->create($data);
    }
}
