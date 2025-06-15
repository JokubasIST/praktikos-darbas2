<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    //  Rodo visų vartotojo įrašų (pajamų / išlaidų) sąrašą
    public function index()
    {
        // Paimami visi prisijungusio vartotojo įrašai su jų kategorijomis
        $transactions = Transaction::with('category')
            ->where('user_id', Auth::id())
            ->get();

        // Grąžinamas vaizdas (Blade), kuriame rodomi šie įrašai
        return view('transactions.index', compact('transactions'));
    }

    //  Rodo formą naujam įrašui sukurti (pajamoms arba išlaidoms)
    public function create()
    {
        // Paimamos visos kategorijos iš DB (kad galėtų vartotojas pasirinkti)
        $categories = Category::all();

        // Grąžinamas vaizdas su forma naujam įrašui
        return view('transactions.create', compact('categories'));
    }

    //  Išsaugo naują įrašą duomenų bazėje
    public function store(Request $request)
    {
        // Patikrina ar įvesti duomenys yra teisingi
        $request->validate([
            'category_id' => 'required|exists:categories,id', 
            'amount' => 'required|numeric',                   
            'date' => 'required|date',                        
            'description' => 'nullable|string',             
        ]);

        // Sukuria naują įrašą naudotojui pagal pateiktus duomenis
        Transaction::create([
            'user_id' => Auth::id(),               // priskiria įrašą prisijungusiam vartotojui
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        // Po išsaugojimo nukreipia atgal į sąrašą su sėkmės žinute
        return redirect()->route('transactions.index')->with('success', 'Įrašas pridėtas!');
    }

    //  Rodo esamo įrašo redagavimo formą
    public function edit($id)
    {
        // Paimamas konkretus vartotojo įrašas pagal ID ir vartotojo ID
        $transaction = Transaction::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail(); // jei neranda – parodoma klaida 404

        // Paimamos visos kategorijos, kad vartotojas galėtų pasirinkti naują
        $categories = Category::all();

        // Grąžinamas redagavimo vaizdas su įrašu ir kategorijų sąrašu
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    //  Atnaujina jau esamą įrašą su naujais duomenimis
    public function update(Request $request, $id)
    {
        // Paimamas tas pats įrašas, kad patikrinti ar priklauso vartotojui
        $transaction = Transaction::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Patikrina ar nauji įvesti duomenys yra teisingi
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        // Atnaujina įrašo reikšmes
        $transaction->update($request->only(['category_id', 'amount', 'date', 'description']));

        // Nukreipia atgal su pranešimu apie sėkmingą atnaujinimą
        return redirect()->route('transactions.index')->with('success', 'Įrašas atnaujintas!');
    }

    //  Ištrina pasirinktą įrašą
    public function destroy($id)
    {
        // Paimamas įrašas, patikrinama ar jis priklauso vartotojui
        $transaction = Transaction::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Pašalinamas įrašas
        $transaction->delete();

        // Nukreipiama atgal su pranešimu apie sėkmingą ištrynimą
        return redirect()->route('transactions.index')->with('success', 'Įrašas pašalintas!');
    }
}
