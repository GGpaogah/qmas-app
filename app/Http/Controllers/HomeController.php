<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function superadminhome()
    {



        return view('superadmin.dashboard');
    }
    public function adminhome()
    {

        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek user gudang, lalu arahkan ke dashboard sesuai dengan gudangnya
        switch ($user->gudang) {
            case 'babat':
                return redirect()->route('admin.gudang.babat');
            case 'turen':
                return redirect()->route('admin.gudang.turen');
            case 'kalimetro':
                return redirect()->route('admin.gudang.kalimetro');
            case 'nganjuk':
                return redirect()->route('admin.gudang.nganjuk');
            case 'cengger_ayam':
                return redirect()->route('admin.gudang.cengger_ayam');
            default:
                return redirect()->route('user.dashboard'); // Dashboard default
        }
    }

    public function userhome()
    {



        return view('user.dashboard');
    }


}
