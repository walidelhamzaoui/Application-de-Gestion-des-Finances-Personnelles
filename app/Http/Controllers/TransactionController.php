<?php

namespace App\Http\Controllers;
use App\Models\Budget;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Récupérer toutes les transactions avec leurs budgets
        $transactions = Transaction::with('budget')
            ->where('id', 'like', '%' . $search . '%')
            ->orWhere('amount', 'like', '%' . $search . '%')
            ->orWhere('type', 'like', '%' . $search . '%')
            ->orWhereHas('budget', function ($query) use ($search) {
                $query->where('category', 'like', '%' . $search . '%');
            })
            ->orWhere('date', 'like', '%' . $search . '%')
            ->paginate(2);

        // Flasher les entrées de formulaire pour maintenir la valeur de recherche
        $request->session()->flashInput($request->input());

        // Retourner la vue avec les transactions filtrées
        return view('transaction.index', ['transactions' => $transactions]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $budgets=Budget::all();
       return view('Transaction.create',['budgets'=>$budgets]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'budget_id' => 'required',
            'type' => 'required',
            'prix' => 'required|numeric',
            'date' => 'required|date',
        ], [
            'budget_id.required' => 'Le champ budget est obligatoire.',
            'type.required' => 'Le champ type est obligatoire.',
            'prix.required' => 'Le champ prix est obligatoire.',
            'prix.numeric' => 'Le champ prix doit être un nombre.',
            'date.required' => 'Le champ date est obligatoire.',
            'date.date' => 'Le champ date doit être une date valide.',
        ]);

        // Votre code pour créer la transaction continue ici...

        if ($user = Auth::user()) {
            $transaction = Transaction::create([
                'budget_id' => $request->budget_id,
                'type' => $request->type,
                'amount' => $request->prix,
                'date' => $request->date,
                'user_id' => $user->id,
            ]);
            return redirect()->route('transaction.index');
        } else {
            return view('auth.login');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        // Récupérer tous les budgets
        $budgets = Budget::all();

        // Retourner la vue d'édition avec la transaction et les budgets
        return view('transaction.edit', ['transaction' => $transaction, 'budgets' => $budgets]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        if ($user = Auth::user()) {
            // Vérifie si l'utilisateur est autorisé à mettre à jour la transaction
            if ($transaction->user_id !== $user->id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            // Met à jour la transaction avec les nouvelles données
            $transaction->update([
                'budget_id' => $request->budget,
                'type' => $request->type,
                'amount' => $request->prix,
                'date' => $request->date,
            ]);

            // Retourne la transaction mise à jour
            return redirect()->route('transaction.index');
        } else {
            // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
            return view('auth.login');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transaction.index');
    }
}
