<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
}
