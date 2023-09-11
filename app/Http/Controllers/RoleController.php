<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $allRoles = Role::all();
        return view('pages.manage-roles.index', compact('allRoles'));
    }

    public function create()
    {
        return view('pages.manage-roles.create');
    }

    public function store(Request $request)
    {
        $newRole = new Role();
        $newRole->role_name = $request->f_role_name;
        $newRole->save();
        $queries_arr = $request->f_query_id;
        if ($queries_arr) {
            foreach ($queries_arr as $key => $value) {
                DB::insert('insert into roles_queries (role_id, query_id) values (?, ?)', [$newRole->id, $value]);
            }
        }
        toastr()->info('Role Created and OK');
        $allRoles = Role::all();
        return redirect()->route('roles.manage.index', compact('allRoles'));
    }


    public function show($role)
    {
        $allIds = [];
        $allRelatedQueryIds = [];
        $singleRole = Role::find($role);
        $allRelatedQueryIds = DB::select('select query_id from roles_queries where (role_id) = (?)', [$role]);
        foreach ($allRelatedQueryIds as $key => $value) {
            array_push($allIds, $value->query_id);
        }
        return view('pages.manage-roles.view', compact(['allIds', 'singleRole']));
    }

    public function edit($role)
    {
        $allIds = [];
        $allRelatedQueryIds = [];
        $singleRole = Role::find($role);
        $allRelatedQueryIds = DB::select('select query_id from roles_queries where (role_id) = (?)', [$role]);
        foreach ($allRelatedQueryIds as $key => $value) {
            array_push($allIds, $value->query_id);
        }
        return view('pages.manage-roles.edit', compact(['allIds', 'singleRole']));
    }


    public function update(Request $request, $role)
    {
        $updatedRole = Role::find($role);
        $updatedRole->role_name = $request->f_role_name;
        $updatedRole->save();
        DB::delete('Delete from roles_queries where (role_id) = (?)', [$updatedRole->id]);
        // Save New Queries 
        $queries_arr = $request->f_query_id;
        if ($queries_arr) {
            // TODO >> Check Similar things To this ?????
            foreach ($queries_arr as $key => $value) {
                DB::insert('insert into roles_queries (role_id, query_id) values (?, ?)', [$updatedRole->id, $value]);
            }
        }
        // Refresh and Redirect to the Home Of Roles + Toaster 
        toastr()->info('Role Created and OK');
        $allRoles = Role::all();
        return redirect()->route('roles.manage.index', compact('allRoles'));
    }


    public function destroy($role)
    {
        $allUsersWithDeletedRole  = User::where('role_id', $role)->get();
        foreach ($allUsersWithDeletedRole as $singleUser) {
            $singleUser->role_id  = 2; // Default Role Id 
            $singleUser->save();
        } // Get All users Before they are Deelted 
        $deletedRole = Role::where('id', $role);
        $deletedRole->delete();
        Toastr()->info('Role is Deleted Successfully');
        return redirect()->route('roles.manage.index');
    }
}
