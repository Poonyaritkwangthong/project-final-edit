<?php


namespace App\Http\Controllers;
use App\Models\UserVote;
use App\Models\Suggestion;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class VoteChartController extends Controller
{
    public function dashboard()
    {
        $vote_counts = DB::table('user_vote')
            ->join('vote', 'user_vote.vote_id', '=', 'vote.id')
            ->join('suggestion', 'user_vote.suggestion_id', '=', 'suggestion.id')
            ->select(
                'suggestion.topic_name',
                DB::raw('
                    SUM(CASE WHEN vote.id = 1 THEN 1 ELSE 0 END) as agree_count,
                    SUM(CASE WHEN vote.id = 2 THEN 1 ELSE 0 END) as disagree_count
                ')
            )
            ->groupBy('suggestion.topic_name')
            ->get();

        $labels = $vote_counts->pluck('topic_name');
        $data_agree = $vote_counts->pluck('agree_count');
        $data_disagree = $vote_counts->pluck('disagree_count');

        return view('vote_count.vote_chart', compact('labels', 'data_agree', 'data_disagree'));
    }
}
