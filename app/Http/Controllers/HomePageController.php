<?php

namespace App\Http\Controllers;
use App\Models\News;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {
        $news = News::take(4)->get();
        return view('home', compact('news'));
    }
}
