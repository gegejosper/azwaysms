<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelController extends Controller
{
    //
    public function dashboard(){
        return view('panel.dashboard');
    }

    public function accounts(){
        return view('panel.accounts');
    }

    public function account_view(){
        return view('panel.accounts-view');
    }
}
