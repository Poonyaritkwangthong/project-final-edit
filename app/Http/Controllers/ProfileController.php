<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function index()
    {
        if (Auth::check() && Customer::where('user_id', Auth::user()->id)->exists()) {
            $profile = Customer::where('user_id', Auth::user()->id)->first();
            return view('profile.index', compact('profile'));
        } else {
            return redirect()->route('profile.create');
        }
    }

    public function create()
    {
        return view('profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'c_img' => 'required',
            'phone_n' => 'required',
            'user_id' => 'required',
        ]);
        $input = $request->all();

        if ($request->hasfile('c_img')); {
            $file = $request->file('c_img');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('images/profiles/', $filename);
            $input['c_img'] = $filename;
        }
        Customer::create($input);

        return redirect()->route('profile.index')->with('success', 'profile Type has been added');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $profile = Customer::where('user_id', Auth()->user()->id)->first();
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $profile)
    {
        $profile = Customer::where('user_id', Auth()->user()->id)->first();
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'c_img' => 'nullable|image',
            'phone_n' => 'required',
            'user_id' => 'required',
        ]);
        if ($request->hasfile('c_img')) {
            $destination = 'images/profiles/' . "$ $profile->c_img";
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('c_img');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('images/profiles/', $filename);
            $profile->c_img = $filename;
        }
        $profile->update();
        $profile->fill($request->post())->save();

        return redirect()->route('profile.index')->with('success', 'profile has been updated');
    }
}
