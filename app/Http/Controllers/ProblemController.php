<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;
use Illuminate\Support\Facades\File;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $problems = Problem::orderBy('id')->paginate(10);
        return view('problem.index', ['problems' => $problems]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('problem.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'problem_name' => 'required',
            'p_img' => 'required',
            'p_detail' => 'required',
            'p_location' => 'required',
            'p_date' => 'required',
        ]);
        $input = $request->all();

        if($request->hasfile('p_img'));
        {
        $file = $request->file('p_img');
        $extention = $file->getClientOriginalExtension();
        $filename = time().'.'. $extention;
        $file->move('images/problems/', $filename);
        $input['p_img'] = $filename;
        }
        Problem::create($input);

        return redirect()->route('problem.index')->with('success','problem Type has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(Problem $problem)
    {
        return view('problem.show',compact('problem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Problem $problem)
    {
        return view('problem.edit',compact('problem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Problem $problem)
    {
        $request->validate([
            'problem_name' => 'required',
            'p_img' => 'required',
            'p_detail' => 'required',
            'p_location' => 'required',
            'p_date' => 'required',
        ]);

        if($request->hasfile('p_img')) {
            $destination = 'images/problems/'."$ $problem->p_img";
            if(File::exists($destination)) {
            File::delete($destination);
            }

            $file = $request->file('p_img');
            $extention = $file->getClientOriginalExtension();
            $filename = time().'.'. $extention;
            $file->move('images/problems/', $filename);
            $problem->p_img = $filename;
            }
            $problem->update();
            $problem->fill($request->post())->save();

        return redirect()->route('problem.index')->with('success','problem has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Problem $problem)
    {
        $problem->delete();
        return redirect()->route('problem.index')->with('success','problem has been deleted');
    }
}
