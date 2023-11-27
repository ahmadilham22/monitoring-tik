<?php

namespace App\Http\Controllers\DataMaster\Category;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Services\DataMaster\CategoryService;
use App\Http\Requests\DataMaster\CategoryRequest;
use App\Repositories\DataMaster\CategoryRepository;

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
        $categoryId = $request->id;
        $validator = Validator::make($request->all(), [
            'kode_kategori' => [
                'required',
                Rule::unique('categories')->ignore($categoryId),
            ],
            'nama_kategori' => 'required',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique' => 'Kode kategori sudah ada.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
        ]);


        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        try {
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
        } catch (\Illuminate\Database\QueryException $e) {
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
        return Response()->json(['data' => $category, 'message' => 'Data Berhasil di Hapus']);
    }
}
