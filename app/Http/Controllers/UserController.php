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

    public function addNewUser(UserRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['avatar'] = FileUploadService::upload($request->file('avatar'));

            $user = User::create($validatedData);

            return $user
                ? redirect()->route('index')->with('success', 'User created successfully!')
                : redirect()->route('form-add')->with('error', 'Something went wrong!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
