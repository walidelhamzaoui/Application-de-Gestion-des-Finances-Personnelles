@extends('Dashboard.dashboard')

@section('header')

@section('main')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center align-items-center">

        <div class="col-lg-7 mt-5 pt-5">

            <form class=" bg-white p-5 rounded  shadow-lg  mb-5 " action="{{route('transaction.store')}}" method='post'>
                @csrf
                <div class="text-center mb-3">
                    <h2> Ajouter transactions financières</h2>
                </div>

                <div class="radio-input my-3 mt-5 ">
                    <input value="revenus" name="type" id="revenus" type="radio">
                    <label for="revenus">les Revenus</label>
                    <input value="dépenses" name="type" id="dépenses" type="radio">
                    <label for="dépenses">les Dépenses</label>

                </div>
                @error('type')
                <span class="text-danger">{{ $message }}</span>
                @enderror




                <div class="form-group ">
                    <label for="prix" class="form-label">prix</label>
                    <input type="number" class="form-control" name="prix" id="prix" placeholder="Entrez prix">
                    @error('prix')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="budget" class="form-label">Catégorie de budget</label>
                    <select class="form-select" aria-label="Catégorie de budget" name="budget_id" id="budget"
                        onchange="updateMaxAmount()" required>
                        <option disabled selected value="" title="Veuillez sélectionner une option valide">Choisir
                        </option>

                        @foreach ($budgets as $budget)
                        <option value="{{ $budget->id }}" id="max_amount" data-max-amount="{{ $budget->max_amount }}">
                            {{ $budget->category }}</option>
                        @endforeach
                    </select>

                    <span class="text-danger" id="message"></span>

                </div>
                <div class="form-group my-3">
                    <label for="date" class="form-label my-2">date</label>
                    <input type="date" class="form-control" name="date" id="date" placeholder="Entrez date">
                    @error('date')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>



                <div class="text-end py-5">
                    <button type="submit" class="btn btn-dark" onclick="valide()">Ajouter </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function updateMaxAmount() {
    var budgetSelect = document.getElementById("budget");
    var prixInput = document.getElementById("prix");
    var dépenses = document.getElementById("dépenses");
    var selectedOption = budgetSelect.options[budgetSelect.selectedIndex];
    var maxAmount = selectedOption.getAttribute("data-max-amount");
    if (dépenses.checked) {


        // Mettre à jour la valeur maximale acceptée dans le champ de prix
        prixInput.setAttribute("max", maxAmount);
        if (prixInput.value == "") {
            budgetSelect.value = "Choisir";
            alert('Veuillez entrer un prix');
        } else {
            console.log('Prix entré');
        }
        // Effacer la valeur de prix si elle dépasse la nouvelle limite
        if (parseFloat(prixInput.value) > parseFloat(maxAmount)) {
            prixInput.value = "";
            budgetSelect.selectedIndex = 0; // Réinitialiser la sélection à l'index 0

            // Afficher une alerte SweetAlert
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Le montant ne peut pas excéde " + maxAmount,
            });
        }
    }

}
</script>

<script src="sweetalert2.all.min.js"></script>

@endsection
