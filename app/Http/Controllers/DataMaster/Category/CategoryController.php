<?php

namespace App\Http\Controllers\DataMaster\Category;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataMaster\CategoryRequest;
use App\Models\DataMaster\Category;
use App\Repositories\DataMaster\CategoryRepository;
use App\Services\DataMaster\CategoryService;
use Exception;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct()
    {
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = $this->categoryRepository->getAll();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('components.actions.goodsCategoryAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        return view('pages.data-master.category.index');
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $this->categoryRepository->create($data);
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }
}
