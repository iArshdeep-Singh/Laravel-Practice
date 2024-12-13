<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Human;

class HumanCotroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $humans = Human::all();
        return view('humanIndex', compact('humans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('human');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:humans,email',
            'age' => 'required|integer|between:18,100',
            'password' => 'required|string|min:8',
        ]);


        Human::create([
            'name' => $request->name,
            'email' => $request->email,
            'age' => $request->age,
            'password' => $request->password
        ]);

        // return redirect()->back()->with('success', 'Human added successfully!');
        return redirect()->route('human.index')->with('success', 'Human added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
