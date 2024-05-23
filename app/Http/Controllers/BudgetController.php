<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 10 est le nombre d'éléments par page, vous pouvez le changer selon vos besoins
        $search = $request->input('search');

        // Assuming $post is a typo and it should be $transactions
        $budgets = Budget::orderBy("id", "desc")
            ->where('id', 'like', '%' . $search . '%')
            ->orWhere('category', 'like', '%' . $search . '%')
            ->orWhere('max_amount', 'like', '%' . $search . '%')
            ->paginate(2);
            $request->session()->flashInput($request->input());
        return view('Budget.index', ["budgets" => $budgets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Budget.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        if($user= Auth::user()){


        // Retrieve the authenticated user


        // Create a budget and associate it with the authenticated user
        $budget = Budget::create([
            'category' => $request->category,
            'max_amount' => $request->maxamount,
            // Add the user_id to associate the budget with the user
            'user_id' => $user->id,
        ]);

        // Return the created budget
        return redirect()->route('budget.index');
    }else{
        return view('auth.login');
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $budget=Budget::findOrFail($id);
        return view('Budget.edit',["budget"=>$budget]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Budget $budget)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Ensure the authenticated user owns the budget
        if ($budget->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Update the budget with the new data
        $budget->update([
            'category' => $request->category,
            'max_amount' => $request->maxamount,
            // No need to update user_id as it should remain the same
        ]);

        // Return the updated budget
        return redirect()->route('budget.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $budget=Budget::findOrFail($id)->delete();
        return redirect()->route('budget.index');
    }
  
}
