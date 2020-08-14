<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticpageController extends Controller
{
    function index() {
        return view('index');
    }
    function login() {
        return view('login');
    }
}
