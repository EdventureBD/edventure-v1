<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        // WITHOUT LIVEWIRE
        $users = User::orderBy('user_type')->get();
        return view('admin.pages.user.index', compact('users'));

        // FOR LIVEWIRE
        // $type = [1, 2, 3];
        // return view('admin.pages.user.index', compact('type'));
    }

    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function edit(User $user)
    {
        return view('admin.pages.user.edit', compact('user'));
    }

    public function destroy(User $user)
    {
        $delete = $user->delete();
        if ($delete) {
            return redirect()->route('user.index')->with('status', 'Course topic successfully deleted!');
        } else {
            return redirect()->route('user.index')->with('failed', 'Course topic deletion failed!');
        }
    }

    public function allAdmin()
    {
        $users = User::where('user_type', 1)->get();
        return view('admin.pages.user.index', compact('users'));

        // for LIVEWIRE
        $type = [1];
        return view('admin.pages.user.index', compact('type'));
    }

    public function allTeacher()
    {
        $users = User::where('user_type', 2)->get();
        return view('admin.pages.user.index', compact('users'));

        // for LIVEWIRE
        // $type = [2];
        // return view('admin.pages.user.index', compact('type'));
    }

    public function allStudent()
    {
        $users = User::where('user_type', 3)->get();
        return view('admin.pages.user.index', compact('users'));

        // for LIVEWIRE
        // $type = [3];
        // return view('admin.pages.user.index', compact('type'));
    }
}
