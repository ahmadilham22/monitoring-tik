<?php

namespace App\Http\Controllers\DataMaster\User;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $data = [
                [
                    'id' => 1,
                    'nama' => 'Ahmad Ilham',
                    'email' => 'angilham2@gmail.com',
                    'username' => 'ang',
                    'alamat' => 'Alamat',
                ],
            ];

            $datatablesData = collect($data)->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'nama' => $item['nama'],
                    'email' => $item['email'],
                    'username' => $item['username'],
                    'alamat' => $item['alamat'],
                    'action' => view('components.actions.usersAction', compact('item'))->render(),
                ];
            });
            return DataTables::of($datatablesData)->addIndexColumn()->make();
        }
        return view('pages.user.index');
    }

    public function detail()
    {
        return view('pages.user.user-detail');
    }
}
