<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function __construct() {}

    public function showListUserPage()
    {
        $users = User::orderByDesc('id')->get();
        return view('index', compact( 'users'));
    }
    
    public function showAddUserPage()
    {
        return view('form-add');
    }

    public function addNewUser(UserRequest $request)
    {
        try {
            $validatedData = $request->validated();

            if ($request->hasFile(key: 'avatar')) {
                $avatarPath = $request->file(key: 'avatar')->store('avatars', 'public');
                $validatedData['avatar'] = $avatarPath ?? null;
            }

            $user = User::create($validatedData);

            if ($user) {
                return redirect()->route('index')->with('success', 'User created successfully!');
            }

            return redirect()->route('form-add')->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
