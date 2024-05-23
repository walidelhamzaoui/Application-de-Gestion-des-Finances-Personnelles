@extends('Dashboard.dashboard')

    <!-- <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> -->




@section('main')
<div class="container mt-5 pt-5" >
    <div class="row justify-content-center align-items-center"> <!-- Utilisation de justify-content-center pour centrer horizontalement -->
        <div class="col-lg-7 mt-5 pt-5" >

        <form class="  bg-white p-5 rounded  shadow-lg  mb-5  " action="{{route('budget.update', $budget->id)}}" method='post'>
      @csrf
      @method('put')
      <div class="text-center">
    <h3> Mettre à jour Budget </h3></div>
            <div class="form-group my-3">
                <label for="category " class="py-2">Category</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ $budget->category}}" aria-describedby="emailHelp"
                    placeholder="Enter category" required>

            </div>
            <div class="form-group my-3">
                <label for="maxamount" class="my-2">Max-Amount</label>
                <input type="text" class="form-control" name="maxamount" id="maxamount"   value="{{$budget->max_amount}}" required>
            </div>
<div class="text-end py-5">
            <button type="submit" class="btn btn-dark">Mettre à jour </button></div>
        </form>
    </div>
</div>
</div>
@endsection
