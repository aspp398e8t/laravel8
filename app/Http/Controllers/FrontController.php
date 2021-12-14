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
        return view('welcome');
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
        $news = News::get();
        return view('news-list', compact('news'));
    }

    public function newsContent($id)
    {
        $news = DB::table('news')->find($id);
        return view('news-content', compact('news'));
    }
    public function createNews()
    {
        News::create([
            'title' => '攜手众社會企業推動臺灣露營區無障礙環境 交通部觀光局連續三年獲社會創新採購獎肯定',
            'date' => '2021-12-08',
            'content' => '臺灣露營夯！越來越多家庭，除了帶小朋友去露營之外，也想帶行動不便的長輩和身心障礙的朋友一起去露營。',
            'image_url' => 'https://www.taiwan.net.tw/pic.ashx?qp=/0042228/13_0042228_2.jpg&sizetype=2',
        ]);
    }
    public function updateNews($id)
    {
        News::find($id)->update([
            'title' => '55566',
            'date' => '2021-12-10',
            'content' => '55',
            'image_url' => 'https://www.taiwan.net.tw/pic.ashx?qp=/0042228/13_0042228_2.jpg&sizetype=2',
        ]);
    }
    public function deleteNews($id)
    {
        News::find($id)->delete([]);
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
