<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVote;
use App\Models\Suggestion;
use App\Models\Vote;


class VotePageController extends Controller
{
    public function index()
    {
        $votepages = Suggestion::all();
        return view('votepage.index', compact('votepages'));
    }

    public function vote($id)
    {
        $suggestion = Suggestion::where('id', '=', $id)->first();
        $vote = Vote::all();
        $uservote = UserVote::get();
        return view('votepage.create', compact('suggestion', 'vote', 'uservote'));
    }

    public function store(Request $request)
    {
        if (Auth()->check()) {
            $request->validate([
                'suggestion_id' => 'required',
                'vote_id' => 'required',
                'user_v_id' => 'required',
            ]);
            if (auth()->user()->id === $request->user_v_id) {
                return redirect()->route('votepage.index')->with('success', 'คุณได้โหวตไปแล้ว');
            } else {
                UserVote::create($request->all());
                return redirect()->route('votepage.index')->with('success', 'คุณได้ลงคะแนนโครงการเรียบร้อย');
            }
        }

    }
}
