<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use DB;

class UserController extends Controller
{
    public function userall()
    {
        $data = DB::table('users')->select(
            'id','name', 'email','role')->paginate();

            return view('admin.users', compact('data'))->with('1',(request()->input('page',1)-1)*5);
    }
}
