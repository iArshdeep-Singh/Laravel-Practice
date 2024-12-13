<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function test(){
        return view("welcome");
    }
}
