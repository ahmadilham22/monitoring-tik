<?php

namespace App\Repositories\DataMaster;

use App\Models\DataMaster\Category;

class CategoryRepository
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category->get();
    }

    public function create($data)
    {
        return $this->category->create($data);
    }
}
