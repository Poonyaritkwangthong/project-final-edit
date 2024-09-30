<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $votes = Vote::orderBy('id')->paginate(10);
        return view('vote.index', ['votes' => $votes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vote.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vote' => 'required',
        ]);
        Vote::create($request->post());

        return redirect()->route('vote.index')->with('success','vote Type has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        return view('vote.show',compact('vote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vote $vote)
    {
        return view('vote.edit',compact('vote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vote $vote)
    {
        $request->validate([
            'vote' => 'required',
        ]);
        $vote->fill($request->post())->save();

        return redirect()->route('vote.index')->with('success','vote has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        $vote->delete();
        return redirect()->route('vote.index')->with('success','vote has been deleted');
    }
}
