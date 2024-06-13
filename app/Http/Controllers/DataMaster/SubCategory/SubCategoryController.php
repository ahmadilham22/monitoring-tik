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
    public function index()
    {
        if (request()->ajax()) {
            $data = SubCategory::with('category')->orderBy('updated_at', 'desc')->get();
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
        $validator = Validator::make($request->all(), [
            'kode_sub_kategori' => [
                'required',
                'unique:sub_categories,kode_sub_kategori,NULL,id,deleted_at,NULL'
            ],
            'nama_sub_kategori' => 'required',
        ], [
            'kode_sub_kategori.required' => 'Kode Sub kategori wajib diisi',
            'kode_sub_kategori.unique' => 'Kode Sub kategori sudah ada',
            'nama_sub_kategori.required' => 'Nama Sub kategori wajib diisi',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 422);
        }

        // try {
        $category = SubCategory::create([
            'categories_id' => $request->categories_id,
            'kode_sub_kategori' => $request->kode_sub_kategori,
            'nama_sub_kategori' => $request->nama_sub_kategori,
        ]);
        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $category]);
        // } catch (\Illuminate\Database\QueryException $e) {
        //     return response()->json(['error' => true, 'message' => 'Gagal memperbarui data', 'errors' => $e->getMessage()]);
        // }
    }
    public function edit($id)
    {
        $subcategory = SubCategory::find($id);
        if ($subcategory) {
            return response()->json(['success' => true, 'data' => $subcategory]);
        } else {
            return response()->json(['success' => true, 'message' => 'Tidak ditemukan']);
        }
    }

    public function update(Request $request, $id)
    {
        $subcategoryId = $id;
        $validator = Validator::make($request->all(), [
            'kode_sub_kategori' => [
                'required',
                Rule::unique('sub_categories')->ignore($subcategoryId)
            ],
            'nama_sub_kategori' => 'required',
        ], [
            'kode_sub_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_sub_kategori.unique' => 'Kode kategori sudah ada.',
            'nama_sub_kategori.required' => 'Nama kategori wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->first()]);
        }

        try {
            $sub_category = SubCategory::findOrFail($subcategoryId);

            $sub_category->categories_id = $request->input('categories_id');
            $sub_category->kode_sub_kategori = $request->input('kode_sub_kategori');
            $sub_category->nama_sub_kategori = $request->input('nama_sub_kategori');

            $sub_category->update();

            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $sub_category]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => true, 'message' => 'Gagal memperbarui data', 'errors' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $sub_category = SubCategory::find($id);
        $sub_category->delete();
        return Response()->json(['data' => $sub_category, 'message' => 'Data Berhasil di Hapus']);
    }
}
