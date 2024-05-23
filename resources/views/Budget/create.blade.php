@extends('Dashboard.dashboard')

@section('header')

@section('main')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center align-items-center">
        <!-- Utilisation de justify-content-center pour centrer horizontalement -->
        <div class="col-lg-7 mt-5 pt-5">
            <form class="bg-white p-5 rounded  shadow-lg  mb-5  " action="{{ route('budget.store') }}" method="post">
                @csrf
                <div class="text-center">
                    <h2 class="mb-4">Ajouter Budget</h2> <!-- Ajout de mb-4 pour un peu d'espace en bas -->
                </div>
                <div class="form-group my-3">
                    <label for="category" class="py-2"> Category</label>
                    <input type="text" class="form-control" id="category" name="category" aria-describedby="emailHelp"
                        placeholder="Entrez la catégorie">
                    @error('category')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group my-3">
                    <label for="maxamount" class="my-2">Max-Amount</label>
                    <input type="text" class="form-control" name="maxamount" id="maxamount"
                        placeholder="Entrez le montant maximum">
                    @error('max_amount')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="text-end">
                    <!-- Centrer le bouton aussi -->
                    <button type="submit" class="btn btn-dark col-lg-2">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
