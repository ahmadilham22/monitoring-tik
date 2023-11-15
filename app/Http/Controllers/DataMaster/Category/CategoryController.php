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
                    return view('pages.data-master.category._action.categoryAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        return view('pages.data-master.category.index');
    }

    public function store(Request $request)
    {
        try {
            $categoryId = $request->id;
            $category = Category::updateOrCreate(
                [
                    'id' => $categoryId
                ],
                [
                    'kode_kategori' => $request->kode_kategori,
                    'nama_kategori' => $request->nama_kategori,
                ]
            );

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $category]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Data telah ada', 'error' => $e->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $category  = Category::where($id)->first();
        return response()->json($category);
    }

    public function destroy(Request $request)
    {
        $category = Category::where('id', $request->id);
        $category->delete();
        return Response()->json($category);
    }
}