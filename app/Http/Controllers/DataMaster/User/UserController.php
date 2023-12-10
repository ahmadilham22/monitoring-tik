<?php

namespace App\Http\Controllers\DataMaster\User;

use Illuminate\Http\Request;
use App\Models\DataMaster\User;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Division;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = User::with('division')->get();
            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    return view('pages.data-master.user._actions.usersAction', compact('data'));
                })->addIndexColumn()->make(true);
        }
        $division = Division::all();
        return view('pages.data-master.user.index', compact('division'));
    }

    // public function store(Request $request)
    // {
    //     $userId = $request->id;
    //     $validator = Validator::make($request->all(), [
    //         'nama' => 'required',
    //         'email' => ['required', Rule::unique('users')->ignore($userId)->whereNull('deleted_at'),],
    //         'password' => 'required',
    //         'role' => 'required',
    //     ], [
    //         'nama.required' => 'Nama wajib diisi',
    //         'email.required' => 'Email wajib diisi',
    //         'email.unique' => 'Email sudah ada',
    //         'password.required' => 'Password wajib diisi',
    //         'role.required' => 'Role wajib diisi',
    //     ]);


    //     if ($validator->fails()) {
    //         return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
    //     }
    //     try {
    //         $user = User::updateOrCreate(
    //             [
    //                 'id' => $userId
    //             ],
    //             [
    //                 'nama' => $request->nama,
    //                 'email' => $request->email,
    //                 'password' => Hash::make($request->password),
    //                 'role' => $request->role,
    //                 'division_id' => $request->division_id,
    //             ]
    //         );

    //         return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $user]);
    //     } catch (\Illuminate\Database\QueryException $e) {
    //         return response()->json(['success' => false, 'message' => 'Data telah ada', 'error' => $e->getMessage()]);
    //     }
    // }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => ['required', Rule::unique('users')->whereNotNull('deleted_at')],
            'password' => 'required',
            'role' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah ada',
            'password.required' => 'Password wajib diisi',
            'role.required' => 'Role wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        try {
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'division_id' => $request->division_id,
            ]);

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $user]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'message' => 'Data telah ada', 'error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json(['success' => true, 'data' => $user]);
        } else {
            return response()->json(['success' => true, 'message' => 'Tidak ditemukan']);
        }
    }

    public function update(Request $request, $id)
    {
        $userId = $id;
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($userId)->where(function ($query) use ($request) {
                    return $query->where('email', $request->email);
                }),
            ],
            'role' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah ada',
            'role.required' => 'Role wajib diisi',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        try {
            $user = User::findOrFail($userId);

            $user->nama = $request->input('nama');
            $user->email = $request->input('email');
            $user->role = $request->input('role');
            $user->division_id = $request->input('division_id');

            if ($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->update();

            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui', 'data' => $user]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui data', 'error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return Response()->json(['data' => $user, 'message' => 'Data Berhasil di Hapus']);
    }

    public function detail($id)
    {
        $data = User::with('division')->findOrFail($id);
        return view('pages.data-master.user.user-detail', compact('data'));
    }
}
