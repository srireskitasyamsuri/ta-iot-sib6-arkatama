<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //index, store, update, destroy
    // show, create, edit

    function index()
    {
        $data['title'] = 'User';
        $data['breadcrumbs'][] = [
            'title' => 'Dashboard', 
            'url' => route('dashboard')
        ];
        $data['breadcrumbs'][] = [
            'title' => 'User' ,
            'url' => 'users.index'
        ];

        $users = User::orderBy('name')->get();
        $data['users'] = $users;

        return view('pages.user.index', $data);
    }
}
