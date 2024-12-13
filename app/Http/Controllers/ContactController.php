<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller




{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:contacts,email',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // return redirect()->back()->with('success', 'Contact added successfully!');
        return redirect('x')->with('success', 'Contact added successfully!');
    }
}