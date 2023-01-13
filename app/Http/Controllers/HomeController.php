<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index(){


        return  view('home.userpage');

    }




    public function redirect()
    {
                $usertype=Auth::user()->usertype;

              //  dd($usertype);

        if ($usertype=='1')

        {
          return  view('admin.home');
        }

        else {
         return   view('dashboard');

        }
    }


}
