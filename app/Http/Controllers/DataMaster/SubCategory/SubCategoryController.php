<?php

namespace App\Http\Controllers\DataMaster\SubCategory;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\DataMaster\SubCategoryRequest;
use App\Models\DataMaster\Category;
use App\Models\DataMaster\SubCategory;
use App\Repositories\DataMaster\CategoryRepository;
use App\Repositories\DataMaster\SubCategoryRepository;
use App\Services\DataMaster\SubCategoryService;

class SubCategoryController extends Controller
{
    private $subCategoryRepository;
    private $categoryRepository;

    public function __construct()
    {
        $this->subCategoryRepository = app(SubCategoryRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function category()
    {
        $data = Category::where('nama_kategori', 'LIKE', '%' . request('q') . '%')->paginate(10);

        return response()->json($data);
    }

    public function index()
    {
        if (request()->ajax()) {
            $data = $this->subCategoryRepository->getAll();
            return datatables()->of($data)
                ->addColumn('action', 'components.actions.goodsSubCategoryAction')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }

        $data = $this->categoryRepository->getAll();
        return view('pages.data-master.sub-category.index', compact('data'));
    }

    public function create()
    {
        return view('pages.data-master.sub-category.create');
    }

    public function store(SubCategoryRequest $request)
    {
        $data = $request->validated();
        $this->subCategoryRepository->create($data);
        return redirect()->route('sub-category.index');
    }
}
