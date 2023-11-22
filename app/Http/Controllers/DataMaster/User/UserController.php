<?php

namespace App\Http\Controllers\DataMaster\User;

use Illuminate\Http\Request;
use App\Models\DataMaster\User;
use Yajra\DataTables\DataTables;
use App\Models\DataMaster\Division;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
        try {
            $userId = $request->id;
            $User = User::updateOrCreate(
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

            return response()->json(['success' => true, 'message' => 'Data berhasil disimpan', 'data' => $User]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, $e]);
        }
    }
    public function edit()
    {
    }

    public function destroy()
    {
    }

    public function detail()
    {
        return view('pages.user.user-detail');
    }
}
