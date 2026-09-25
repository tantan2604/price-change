<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.user');
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {

            $data = User::select([
                'id',
                'user_name',
                'role',
                'email',
                'created_at'
            ]);

            return DataTables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    return '
                        <button class="btn btn-primary btn-sm edit-btn" 
                        data-id="' . $row->id . '" 
                        data-user_name="' . $row->user_name . '" 
                        data-role="' . $row->role . '"  
                        data-email="' . $row->email . '" >Edit</button>

                        <button class="btn btn-danger btn-sm delete-btn"
                        data-id="' . $row->id . '" >Delete</button>
                    ';
                })

                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function updateUser(Request $request)
    {
        // dd($request->all());

        User::where('id', $request->id)
            ->update([
                'user_name' => $request->user_name,
                'role' => $request->role,
                'email' => $request->email,
            ]);
    }


    public function deleteUser(Request $request)
    {
        // dd($request->id);
        $data = User::where('id', $request->id)
            ->update([
                'status' => '0'
            ]);

        // dd($data);
    }


    public function addUser(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'role' => 'required|in:admin,user',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed'
            ],
        ]);

        User::create([
            'user_name' => $request->user_name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User added successfully.'
        ]);
    }
}
