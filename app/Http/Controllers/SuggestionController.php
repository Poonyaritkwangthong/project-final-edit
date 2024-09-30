<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suggestion;


class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggestions = Suggestion::orderBy('id')->paginate(10);
        return view('suggestion.index', ['suggestions' => $suggestions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suggestion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'topic_name' => 'required|unique:suggestion,topic_name,null,id,user_s_id,' . auth()->id(),
            's_detail' => 'required',
        ], [
            'topic_name.required' => 'กรุณาระบุชื่อหัวข้อ',
            'topic_name.unique' => 'มีหัวข้อนี้ในระบบแล้ว',
            's_detail.required' => 'กรุณาระบุรายละเอียดหัวข้อ',
        ]);

        Suggestion::create([
            'topic_name' => $request->topic_name,
            's_detail' => $request->s_detail,
            'user_s_id' => auth()->id(),
        ]);


        return redirect()->route('suggestion.index')->with('success','suggestion Type has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Suggestion $suggestion)
    {
        return view('suggestion.show',compact('suggestion',));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suggestion $suggestion)
    {

        return view('suggestion.edit',compact('suggestion',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suggestion $suggestion)
    {
        $request->validate([
            'topic_name' => 'required',
            's_detail' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'user_s_id' => 'nullable',
        ]);
        $suggestion->fill($request->post())->save();

        return redirect()->route('suggestion.index')->with('success','suggestion has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suggestion $suggestion)
    {
        $suggestion->delete();
        return redirect()->route('suggestion.index')->with('success','suggestion has been deleted');
    }
}
