<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::orderBy('id')->paginate(10);
        return view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_news' => 'required',
            'n_img' => 'required',
            'n_location' => 'required',
            'n_detail' => 'required',
            'n_date' => 'required',
        ]);

        $input = $request->all();

        if($request->hasfile('n_img'));
        {
        $file = $request->file('n_img');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'. $extention;
        $file->move('images/news/', $filename);
        $input['n_img'] = $filename;
        }
        News::create($input);

        return redirect()->route('news.index')->with('success','news Type has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('news.show',compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('news.edit',compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'name_news' => 'required',
            'n_img' => 'nullable|image',
            'n_location' => 'required',
            'n_detail' => 'required',
            'n_date' => 'required',
        ]);

        if($request->hasfile('n_img')) {
            $destination = 'images/news/'."$ $news->n_img";
            if(File::exists($destination)) {
            File::delete($destination);
            }

            $file = $request->file('n_img');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'. $extention;
            $file->move('images/news/', $filename);
            $news->n_img = $filename;
            }
            $news->update();
            $news->fill($request->post())->save();

        return redirect()->route('news.index')->with('success','news has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success','news has been deleted');
    }
}
