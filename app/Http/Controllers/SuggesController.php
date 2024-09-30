<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Suggestion;

class SuggesController extends Controller
{
    public function index(){
        $sugges = Suggestion::all();
        return view('sugges.index', compact('sugges'));
    }

    public function create()
    {
        return view('sugges.create');
    }

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

        return redirect()->route('sugges.index')->with('success','หัวข้อของคุณถูกเพิ่มในระบบเเล้ว!');
    }

}
