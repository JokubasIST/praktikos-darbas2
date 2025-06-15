<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //  Rodo visų kategorijų sąrašą
    public function index()
    {
        // Paimamos visos kategorijos iš duomenų bazės
        $categories = Category::all();

        // Grąžinamas vaizdas (Blade šablonas), į kurį perduodamos kategorijos
        return view('categories.index', compact('categories'));
    }

    //  Rodo formą naujai kategorijai sukurti
    public function create()
    {
        // Grąžina Blade šabloną su tuščia forma kategorijai sukurti
        return view('categories.create');
    }

    //  Išsaugo naują kategoriją į duomenų bazę
    public function store(Request $request)
    {
        // Patikrina ar visi privalomi formos duomenys įvesti teisingai
        $request->validate([
            'name' => 'required|string|max:255', 
            'type' => 'required|in:pajamos,islaidos', 
        ]);

        // Sukuria naują kategorijos įrašą pagal formos duomenis
        Category::create($request->all());

        // Nukreipia atgal į kategorijų sąrašą su pranešimu apie sėkmingą sukūrimą
        return redirect()->route('categories.index')->with('success', 'Kategorija sukurta!');
    }

    //  Rodo formą esamos kategorijos redagavimui
    public function edit(Category $category)
    {
        // Grąžina Blade šabloną su užpildyta forma redagavimui
        return view('categories.edit', compact('category'));
    }

    //  Atnaujina kategorijos duomenis duomenų bazėje
    public function update(Request $request, Category $category)
    {
        // Patikrina ar nauji duomenys įvesti teisingai
        $request->validate([
            'name' => 'required|string|max:255', 
            'type' => 'required|in:pajamos,islaidos', 
        ]);

        // Atnaujina konkrečios kategorijos duomenis
        $category->update($request->all());

        // Grąžina atgal į sąrašą su pranešimu apie atnaujinimą
        return redirect()->route('categories.index')->with('success', 'Kategorija atnaujinta!');
    }

    //  Ištrina pasirinktą kategoriją iš duomenų bazės
    public function destroy(Category $category)
    {
        // Ištrina nurodytą kategoriją
        $category->delete();

        // Grąžina atgal į sąrašą su pranešimu apie ištrynimą
        return redirect()->route('categories.index')->with('success', 'Kategorija ištrinta!');
    }
}
