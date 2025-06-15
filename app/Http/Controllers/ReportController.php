<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Šis metodas pateikia finansinę ataskaitą.
    // Leidžia filtruoti įrašus pagal datą, suskaičiuoja pajamas, išlaidas, likutį
    // ir grąžina rezultatus į `reports.index` Blade šabloną.
    public function index(Request $request)
    {
        // Gauti prisijungusio vartotojo ID
        $userId = Auth::id();

        // Gauti datos filtrus iš užklausos (nuo ir iki)
        $from = $request->input('from');
        $to = $request->input('to');

        // Sukuriama užklausa, kuri paima naudotojo įrašus kartu su jų kategorijomis
        $query = Transaction::with('category')->where('user_id', $userId);

        // Jei nurodyta pradžios data – filtruoti nuo šios datos
        if ($from) {
            $query->whereDate('date', '>=', $from);
        }

        // Jei nurodyta pabaigos data – filtruoti iki šios datos
        if ($to) {
            $query->whereDate('date', '<=', $to);
        }

        // Įvykdyti užklausą ir gauti filtruotus rezultatus
        $transactions = $query->get();

        // Apskaičiuoti bendras pajamas (kur tipas = 'pajamos')
        $income = $transactions->where('category.type', 'pajamos')->sum('amount');

        // Apskaičiuoti bendras išlaidas (kur tipas = 'islaidos')
        $expenses = $transactions->where('category.type', 'islaidos')->sum('amount');

        // Apskaičiuoti likutį: pajamos - išlaidos
        $balance = $income - $expenses;

        // Grupavimas pagal kategorijos pavadinimą ir sumų apskaičiavimas kiekvienai grupei
        $byCategory = $transactions->groupBy('category.name')->map(function ($group) {
            return $group->sum('amount');
        });

        // Grąžinti `reports.index` vaizdą su visais duomenimis
        return view('reports.index', compact(
            'transactions',
            'income',
            'expenses',
            'balance',
            'byCategory',
            'from',
            'to'
        ));
    }
}
