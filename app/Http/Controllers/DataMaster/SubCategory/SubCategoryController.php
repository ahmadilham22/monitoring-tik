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

    public function index()
    {
        if (request()->ajax()) {
            $data = $this->subCategoryRepository->getAll();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.sub-category._action.subCategoryAction', compact('data'));
                })->addIndexColumn()->make(true);
        }

        $data = $this->categoryRepository->getAll();
        return view('pages.data-master.sub-category.index', compact('data'));
    }

    public function store(Request $request)
    {
        try {
            $subCategoryId = $request->id;
            $subCategory = SubCategory::updateOrCreate(
                [
                    'id' => $subCategoryId
                ],
                [
                    'categories_id' => $request->categories_id,
                    'kode_sub_kategori' => $request->kode_sub_kategori,
                    'nama_sub_kategori' => $request->nama_sub_kategori,
                ]
            );

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $subCategory]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data telah ada', 'error' => $e->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $subCategory  = SubCategory::where($id)->first();
        return response()->json($subCategory);
    }

    public function destroy(Request $request)
    {
        $subCategory = SubCategory::where('id', $request->id);
        $subCategory->delete();
        return Response()->json($subCategory);
    }
}
