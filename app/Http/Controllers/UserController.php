<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('administrator.user.all', compact('users'));
    }

    public function add()
    {
        return view('administrator.user.add');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile_no' => 'nullable|string|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);


        $user = new User();
        $user->client_id = Auth::user()->client_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        $user->password = bcrypt($request->password);
        $user->role_id = 2;
        $user->user_id = Auth::id();
        $user->save();

        $user->syncPermissions($request->permission);

        return redirect()->route('user_all')->with('message', 'User add successfully.');
    }

    public function edit(User $user)
    {
        $this->clientCheck($user);
        return view('administrator.user.edit', compact('user'));
    }

    public function editPost(User $user, Request $request)
    {
        $this->clientCheck($user);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'mobile_no' => 'nullable|string|unique:users,mobile_no,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile_no;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        $user->syncPermissions($request->permission);

        return redirect()->route('user_all')->with('message', 'User edit successfully.');
    }

    public function userDatatable(Request $request)
    {
        $query = User::with('user')->where('client_id', Auth::user()->client_id)->whereIn('role_id', [1, 2]);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('role_id', function (User $user) {
                if ($user->role_id == 1) {
                    return 'Super Admin ';
                } elseif ($user->role_id == 2) {
                    return 'Admin';
                } elseif ($user->role_id == 3) {
                    return 'Employee';
                }
            })
            ->editColumn('status', function (User $user) {
                if ($user->status == 1) {
                    return '<span>Enable</status>';
                } else {
                    return '<span>Disable</status>';
                }
            })
            ->addColumn('action', function (User $user) {
                $btn = '';
                if (Auth::user()->can('user_edit')) {
                    $btn .= '<a class="btn btn-info btn-sm" href="' . route('user_edit', ['user' => $user->id]) . '">Edit</a>';
                }

                return $btn;
            })
            ->rawColumns(['action', 'status', 'role_id'])
            ->toJson();
    }
}
