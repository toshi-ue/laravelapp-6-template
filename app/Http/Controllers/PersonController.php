<?php

namespace App\Http\Controllers;

use App\Person; // TODO: 自動補完されない
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index(Request $request)
    {
        $items = Person::all();
        return view('person.index', ['items' => $items]);
    }
}
