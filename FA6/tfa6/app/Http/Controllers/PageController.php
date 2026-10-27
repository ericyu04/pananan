<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        $data = [
            'developer' => 'Ericson John Yu',
            'course' => 'IT0049',
            'description' => 'Hello!',
        ];
        return view('about', $data);
    }
}
