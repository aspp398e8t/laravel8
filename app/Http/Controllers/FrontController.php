<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    //
    public function index()
    {
        return view('index');
    }

    public function newslist()
    {
        $news = News::get();
        return view('front.news.list', compact('news'));
    }

    public function newsContent($id)
    {
        $news = DB::table('news')->find($id);
        return view('front.news.content', compact('news'));
    }


    public function contact(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'content' => $request->content,
        ]);
        return redirect('/news');
    }
}
