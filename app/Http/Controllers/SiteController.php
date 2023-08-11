<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.pages.home');
    }

    public function trading()
    {
        return view('site.pages.trading');
    }

    public function deposit()
    {
        return view('site.pages.deposit');
    }

    public function withdrawal()
    {
        return view('site.pages.withdrawal');
    }

    public function about()
    {
        return view('site.pages.about');
    }
}
