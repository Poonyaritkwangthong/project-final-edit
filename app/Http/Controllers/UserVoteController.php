<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserVote;
use App\Models\Suggestion;

class UserVoteController extends Controller
{
    public function index(){
        $suggestions = Suggestion::all();
        return view('user_vote.index', compact('suggestions'));
    }
    public function result($id){
        $result = UserVote::where('suggestion_id','=', $id)->first();
        $agree = UserVote::where('suggestion_id','=', $id)->where('vote_id', '=', '1')->get()->count();
        $disagree = UserVote::where('suggestion_id','=', $id)->where('vote_id', '=', '2')->get()->count();
        return view('user_vote.result', compact('result','agree','disagree'));
    }
}
