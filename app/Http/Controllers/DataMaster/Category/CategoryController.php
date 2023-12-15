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

    public function index()
    {
        if (request()->ajax()) {
            $data = Category::orderBy('updated_at', 'desc')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.category._action.tesAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        return view('pages.data-master.category.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kategori' => [
                'required',
                'unique:categories,kode_kategori,NULL,id,deleted_at,NULL'
            ],
            'nama_kategori' => 'required',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique' => 'Kode kategori sudah ada.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->first()]);
        }

        try {
            $category = Category::create([
                'kode_kategori' => $request->kode_kategori,
                'nama_kategori' => $request->nama_kategori,
            ]);
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $category]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => true, 'message' => 'Gagal memperbarui data', 'errors' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $category = Category::find($id);
        if ($category) {
            return response()->json(['success' => true, 'data' => $category]);
        } else {
            return response()->json(['success' => true, 'message' => 'Tidak ditemukan']);
        }
    }

    public function update(Request $request, $id)
    {
        $categoryId = $id;
        $validator = Validator::make($request->all(), [
            'kode_kategori' => [
                'required',
                Rule::unique('categories')->ignore($categoryId)
            ],
            'nama_kategori' => 'required',
        ], [
            'kode_kategori.required' => 'Kode kategori wajib diisi.',
            'kode_kategori.unique' => 'Kode kategori sudah ada.',
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()->first()]);
        }

        try {
            $category = Category::findOrFail($categoryId);

            $category->kode_kategori = $request->input('kode_kategori');
            $category->nama_kategori = $request->input('nama_kategori');

            $category->update();

            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $category]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => true, 'message' => 'Gagal memperbarui data', 'errors' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return Response()->json(['data' => $category, 'message' => 'Data Berhasil di Hapus']);
    }
}
