<?php

namespace App\Http\Controllers\DataMaster\User;

use Illuminate\Http\Request;
use App\Models\DataMaster\User;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Division;
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

    public function store(Request $request)
    {
        $userId = $request->id;
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => ['required', Rule::unique('users')->whereNull('deleted_at')],
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
            $user = User::updateOrCreate(
                [
                    'id' => $userId
                ],
                [
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'division_id' => $request->division_id,
                ]
            );

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $user]);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['success' => false, 'message' => 'Data telah ada', 'error' => $e->getMessage()]);
        }
    }
    public function edit(Request $request)
    {
        $id = array('id' => $request->id);
        $user  = User::where($id)->first();
        return response()->json($user);
    }

    public function destroy(Request $request)
    {
        $user = User::where('id', $request->id);
        $user->delete();
        return Response()->json(['data' => $user, 'message' => 'Data Berhasil di Hapus']);
    }

    public function detail()
    {
        return view('pages.user.user-detail');
    }
}
