<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function superadminhome()
    {



        return view('superadmin.dashboard');
    }
    public function adminhome()
    {



        return view('admin.dashboard');
    }

    public function userhome()
    {



        return view('user.dashboard');
    }


}
