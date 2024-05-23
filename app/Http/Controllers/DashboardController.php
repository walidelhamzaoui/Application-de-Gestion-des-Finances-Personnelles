<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\budget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{




    public function index(Request $request)
    {
        $search = $request->input('search');

        $transactions = Transaction::with('budget')
            ->orderBy("transactions.date", "desc") // Ordonner par date
            ->leftJoin('budgets', 'transactions.budget_id', '=', 'budgets.id')
            ->where(function ($query) use ($search) {
                $query->where('transactions.id', 'like', '%' . $search . '%')
                    ->orWhere('transactions.amount', 'like', '%' . $search . '%')
                    ->orWhere('transactions.type', 'like', '%' . $search . '%')
                    ->orWhere('budgets.category', 'like', '%' . $search . '%')
                    ->orWhere('transactions.date', 'like', '%' . $search . '%');
            })
            ->paginate(6);
        $request->session()->flashInput($request->input());

        // Récupérer tous les montants de dépenses
        $totalDepenses = Transaction::where('type', 'dépenses')->sum('amount');

        // Récupérer tous les montants de revenus
        $totalRevenus = Transaction::where('type', 'revenus')->sum('amount');

        // Calculer le total max_amount pour tous les budgets
        $totalMaxAmount = Budget::sum('max_amount');

        // Récupérer le montant maximum pour le mois dernier
        $firstDayLastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastDayLastMonth = Carbon::now()->subMonth()->endOfMonth();
        $maxAmountLastMonth = Budget::whereBetween('created_at', [$firstDayLastMonth, $lastDayLastMonth])->sum('max_amount');

        // Suivi des dépenses par jour
        $dailyExpenses = Transaction::where('type', 'dépenses')
            ->select(DB::raw('date(transactions.date) as day'), DB::raw('sum(amount) as total_amount'))
            ->groupBy(DB::raw('date(transactions.date)'))
            ->orderBy(DB::raw('date(transactions.date)'), 'desc')
            ->get();

        // Passer les données à la vue pour affichage dans le graphique
        return view('Dashboard.chart graphique', [
            'totalDepenses' => $totalDepenses,
            'totalRevenus' => $totalRevenus,
            'totalMaxAmount' => $totalMaxAmount,
            'maxAmountLastMonth' => $maxAmountLastMonth,
            'transactions' => $transactions,
            'dailyExpenses' => $dailyExpenses, // Ajout des dépenses par jour
        ]);

    }

}
