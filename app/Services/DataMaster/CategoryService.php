<?php

namespace App\Services\DataMaster;

use App\Repositories\DataMaster\CategoryRepository;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }

    public function createCategory($data)
    {
        return $this->categoryRepository->create($data);
    }
}
