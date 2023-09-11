<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $allUsers = User::orderBy('approved', 'ASC')
            ->orderBy('email_verified_at', 'DESC')
            ->get();
        return view('pages.manage-users.index', compact('allUsers'));
    }

    public function edit($user)
    {
        $singleUser = User::find($user);
        return view('pages.manage-users.edit', compact('singleUser'));
    }

    public function update(Request $request, $user)
    {
        $updatedUser = User::find($user);
        $updatedUser->role_id = $request->f_role_id;
        $updatedUser->save();
        toastr()->info('User updated and OK');
        $allUsers = User::all();
        return redirect()->route('users.manage.index', compact('allUsers'));
    }

    public function toggleApproval(Request $request, $userId)
    {
        $toggledUser = User::find($userId);
        $toggledUser->approved = !$toggledUser->approved;
        $toggledUser->save();
        return redirect()->route('users.manage.index');
    }

    public function showUserData($user)
    {
        $singleUser = User::find($user);
        return view('pages.manage-users.show', compact('singleUser'));
    }

    public function destroy($user)
    {
        //  This is the Controller , But still need to add in the ui 
        $deleteduser = User::where('id', $user);
        $deleteduser->delete();
        Toastr()->info('user is Deleted Successfully');
        return redirect()->route('users.manage.index');
    }
}
