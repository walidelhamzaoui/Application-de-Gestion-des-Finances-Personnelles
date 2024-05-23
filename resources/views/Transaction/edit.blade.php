@extends('Dashboard.dashboard')

@section('main')
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-7 mt-5 pt-5">
                <form class="bg-white p-5 rounded shadow-lg mb-5" action="{{ route('transaction.update', $transaction->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="text-center">
                        <h3>Mettre à jour la transaction</h3>
                    </div>
                    <div class="form-group my-3">
                        <select class="form-select" name="budget" id="budget_id">
                            <option value="">Sélectionner un budget</option>
                            @foreach ($budgets as $budget)
                                <option value="{{ $budget->id }}" {{ $transaction->budget_id == $budget->id ? 'selected' : '' }}>
                                    {{ $budget->category }} 
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">Type:</label>
                        <input type="text" id="type" name="type" class="form-control" value="{{ $transaction->type }}" required>
                    </div>

                    <div class="form-group my-2">
                        <label for="prix">Montant:</label>
                        <input type="text" id="prix" name="prix" class="form-control" value="{{ $transaction->amount }}"  required>
                    </div>

                    <div class="form-group my-2">
                        <label for="date">Date:</label>
                        <input type="date" id="date" name="date" class="form-control" value="{{ $transaction->date }}"  required>
                    </div>

                    <div class="form-group text-end py-5">
                        <button type="submit" class="btn btn-dark">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
