<?php

namespace App\Http\Controllers\DataMaster\SubCategory;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Category;
use App\Http\Controllers\Controller;
use App\Models\DataMaster\SubCategory;
use Illuminate\Support\Facades\Validator;
use App\Services\DataMaster\SubCategoryService;
use App\Repositories\DataMaster\CategoryRepository;
use App\Http\Requests\DataMaster\SubCategoryRequest;
use App\Repositories\DataMaster\SubCategoryRepository;

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
            $data = SubCategory::with('category')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.sub-category._action.subCategoryAction', compact('data'));
                })->addIndexColumn()->make(true);
        }

        $data = Category::orderBy('nama_kategori')->get();
        return view('pages.data-master.sub-category.index', compact('data'));
    }

    public function store(Request $request)
    {
        $subCategoryId = $request->id;
        $validator = Validator::make($request->all(), [
            'kode_sub_kategori' => [
                'required',
                Rule::unique('sub_categories')->ignore($subCategoryId),
            ],
            'nama_sub_kategori' => 'required',
        ], [
            'kode_sub_kategori.required' => 'Kode Sub kategori wajib diisi',
            'kode_sub_kategori.unique' => 'Kode Sub kategori sudah ada',
            'nama_sub_kategori.required' => 'Nama Sub kategori wajib diisi',
        ]);


        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }
        try {
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
        } catch (\Illuminate\Database\QueryException $e) {
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
        return Response()->json(['data' => $subCategory, 'message' => 'Data berhasil di Hapus']);
    }
}
