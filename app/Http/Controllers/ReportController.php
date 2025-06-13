<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        $from = $request->input('from');
        $to = $request->input('to');

        $query = Transaction::with('category')->where('user_id', $userId);

        if ($from) {
            $query->whereDate('date', '>=', $from);
        }

        if ($to) {
            $query->whereDate('date', '<=', $to);
        }

        $transactions = $query->get();

        $income = $transactions->where('category.type', 'pajamos')->sum('amount');
        $expenses = $transactions->where('category.type', 'islaidos')->sum('amount');
        $balance = $income - $expenses;

        $byCategory = $transactions->groupBy('category.name')->map(function ($group) {
            return $group->sum('amount');
        });

        return view('reports.index', compact('transactions', 'income', 'expenses', 'balance', 'byCategory', 'from', 'to'));
    }
}
