<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct() {}

    public function showListUserPage()
    {
        $users = User::orderByDesc('id')->get();
        return view('index', compact('users'));
    }

    public function showAddUserPage()
    {
        return view('form-add');
    }

    public function showEditUserPage($id)
    {
        $user = User::find($id);
        return view('form-edit', compact('user'));
    }

    public function addNewUser(UserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['avatar'] = FileUploadService::upload($request->file('avatar'), 'avatars');

            $user = User::create($validatedData);

            return $user
                ? redirect()->route('index')->with('success', 'User created successfully!')
                : redirect()->route('form-add')->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function editUser(UserRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $user = User::find($id);
            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    FileUploadService::delete($user->avatar);
                }
                $validatedData['avatar'] = FileUploadService::upload($request->file('avatar'), 'avatars');
            }

            $user->update($validatedData);

            return $user
                ? redirect()->route('index')->with('success', 'User updated successfully!')
                : back()->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('index')->with('success', 'User deleted successfully!');
        }

        return back()->with('error', 'User not found!');
    }
}
