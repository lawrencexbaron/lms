<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollController extends Controller
{
    //
    public function enrolled(Request $request) : View
    {
        return view('enroll.index', [
            'user' => $request->user(),
        ]);
    }
}
