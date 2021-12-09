<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }
    public function hello()
    {
        $name = 'Leo';
        $age = 18;
        $gender = 'male';

        return view('hello', (compact('name', 'age', 'gender')));
    }
    public function news()
    {
        $news = DB::table('news')->get();
        return view('news-list', compact('news'));
    }

    public function newsContent($id)
    {
        $news = DB::table('news')->find($id);
        return view('news-content', compact('news'));
    }
}
