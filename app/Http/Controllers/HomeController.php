<?php

namespace Raffles\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('layouts.app');
    }
}
