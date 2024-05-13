<?php

namespace App\Http\Controllers\frontend;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home(){
        $allNews = News::where('isBlog','0')->latest()->get();
        $blogs = News::where('isBlog','1')->latest()->get();
        return view('welcome', compact('allNews','blogs'));
    }

    public function newsdetail($blog){
        return view('newsdetail', compact('blog'));
    }
}
