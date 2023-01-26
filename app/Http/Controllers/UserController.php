<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\SBU;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();

        return view('auth.user.index', compact('users', 'SBUs'));
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        User::create($data);

        return redirect()->back()->with('success', 'Success!');
    }

    public function edit(User $user)
    {
        $SBUs = SBU::orderBy('sbu_name', 'asc')->get();
        return view('auth.user.edit', compact('user', 'SBUs'));
    }

    public function update(User $user, UserRequest $request)
    {
        $data = $request->password ? $request->validated() : $request->safe()->except('password');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->back()->with('success', 'Success!');
    }

    public function destroy(User $user)
    {
        return $user;
        $user->delete();
        return redirect()->back()->with('success', 'Success!');
    }
}
