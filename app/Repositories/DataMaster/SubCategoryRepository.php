<?php

namespace App\Repositories\DataMaster;

use App\Models\DataMaster\SubCategory;

class SubCategoryRepository
{
    protected $subCategory;
    public function __construct(SubCategory $subCategory)
    {
        $this->subCategory = $subCategory;
    }

    public function getAll()
    {
        return $this->subCategory->get();
    }

    public function create($data)
    {
        return $this->subCategory->create($data);
    }
}