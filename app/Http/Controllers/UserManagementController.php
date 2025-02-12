<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\UserManagement;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{
    public function addUser(Request $request)
    {
        // dd($request->all());

        UserManagement::create([
            'fullname' => $request->txt_fullname,
            'age'      => $request->txt_age,
            'email'    => $request->txt_email,
            'address'  => $request->txt_address,
            'role_id'  => $request->role_id

        ]);
    }


    public function defaultPage()
    {
        $data['user_roles'] = Role::where('status', '1')->get();
        return view('index', $data);
        // return view('index');

    }


    public function displayUsers()
    {

        $data = UserManagement::with([
            'UserRole' => function ($query) {
                $query->where('status', '1');
            }
            //can add other model
        ])
            ->where('status', '1')
            ->get();



        // dd($data);
        // return response()->json($data); 

        return DataTables::of($data)

            ->addColumn('id', function ($row) {
                return $row->id;
            })

            ->addColumn('fullname', function ($row) {
                return $row->fullname;
            })

            ->addColumn('age', function ($row) {
                return $row->age;
            })

            ->addColumn('email', function ($row) {
                return $row->email;
            })

            ->addColumn('address', function ($row) {
                return $row->address;
            })

            ->addColumn('role', function ($row) {

                // if the id value is 2 or more
                $role_id = explode(', ', $row->role_id); //parsing string into array
                $role_name = Role::whereIn('id', $role_id)->pluck('role')->toArray(); //find Id using whereIn 

                return  implode(' ,', $role_name); //return rolename parsed array into string
            })


            ->addColumn('status', function ($row) {
                if ($row->status = 1) {
                    return 'active';
                } elseif ($row->status = 0) {
                    return 'inactive';
                }
                // return $row->status;
            })


            ->addColumn('action', function ($row) {
                return '<button type="button" class="btn btn-primary btn_update" id="" 
                data-id="' . $row->id . '" data-fullname="' . $row->fullname . '" data-age="' . $row->age . '"  data-email="' . $row->email . '"   data-address="' . $row->address . '" 
                 data-role="' . $row->role_id . '" 
                >Update</button>
            <button type="button" class="btn btn-warning btn_delete" id="" data-id="' . $row->id . '" data-fullname="' . $row->fullname . '" data-age="' . $row->age . '"  data-email="' . $row->email . '"   data-address="' . $row->address . '" 
                 data-role="' . $row->role_id . '" 
            >delete</button>
            ';
            })

            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }


    public function updateUser(Request $request)
    {
        // dd($request->all());

        UserManagement::where('id', $request->id)
            ->update([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'age' => $request->age,
                'address' => $request->address,
                'role_id' => $request->role,
            ]);
    }



    public function deleteUser(Request $request)
    {
        // dd($request->id);
        $data = UserManagement::where('id', $request->id)
            ->update([
                'status' => '0'
            ]);

        // dd($data);
    }
}
