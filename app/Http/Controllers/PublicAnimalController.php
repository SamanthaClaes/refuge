<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class PublicAnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::all();
        return view('animals.index', compact('animals'));
    }

    public function show(Animal $animal)
    {
        return view('animals.show', compact('animal'));
    }
    public function welcome()
    {
        $animals = Animal::all();
        return view('welcome', compact('animals'));
    }

}
