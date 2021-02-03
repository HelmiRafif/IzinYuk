<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class User extends Controller
{
    public function userall()
    {
        $data = DB::table('users')->select(
            'id','name', 'email','role')->paginate();

            return view('admin.users', compact('data'))->with('1',(request()->input('page',1)-1)*5);
    }
}
