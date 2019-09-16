<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomesController extends Controller
{
    /**
     * Load dashboard page
     * @method dashboard
     * @param null
     */
    public function dashboard()
    {
       return view('admin.pages.index');
    }
}
