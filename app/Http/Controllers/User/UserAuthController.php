<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function login()
    {
        return view('auth.login');
    }

    function register()
    {
        return view('auth.regist');
    }

    public function userall()
    {
        $data = DB::table('users')->select(
            'id','name', 'email','role')->paginate();

            return view('admin.users', compact('data'))->with('1',(request()->input('page',1)-1)*5);
    }
}