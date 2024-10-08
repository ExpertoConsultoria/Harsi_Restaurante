<?php

namespace App\Http\Controllers;

class ErrorsExceptions extends Controller
{
    public function index() {
        return view('errors.error');
    }

}
