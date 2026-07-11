<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function loginPage(){
        return view('login');
    }

    public function registerPage(){
        return view('register');
    }

    public function dashboardPage(){
        return view('dashboard.index');
    }

    public function kasirIndexPage(){
        return view('dashboard.kasir.index');
    }
    public function stockerIndexPage(){
        return view('dashboard.stocker.index');
    }
    public function ownerIndexPage(){
        return view('dashboard.owner.index');
    }
}
