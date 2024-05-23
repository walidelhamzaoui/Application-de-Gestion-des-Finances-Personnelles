@extends('Dashboard.dashboard')


@section('header')
<!-- <div class="form-group col-5 text-end">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search User Data" />
        </div> -->


@endsection
@section('user')
<main class="py-6 bg-surface-secondary">
    <div class="container-fluid">
        <div class="row g-6 mb-6">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col ">
                                <span class="h6 font-semibold text-muted text-sm d-block mb-2 ">Le Total Maximum </span>

                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-tertiary text-white text-lg rounded-circle">
                                    <i class="bi bi-coin"></i>
                                </div>
                            </div>
                        </div>
                        <div class=" mb-0 text-sm">
                            <span class="badge badge-pill bg-soft-success text-success me-2">
                                {{ $totalMaxAmount }} $
                            </span>
                            <span class="text-nowrap text-xs text-muted">Le Montant Maximum</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="h6 font-semibold text-muted text-sm d-block mb-2">Le Total Revenus</span>

                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                            </div>
                        </div>
                        <div class=" mb-0 text-sm">
                            <span class="badge badge-pill bg-soft-success text-success me-2">
                                <i class="bi bi-arrow-up me-1"></i> {{ $totalRevenus }} $
                            </span>
                            <span class="text-nowrap text-xs text-muted"> Le montant Revenus</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="h6 font-semibold text-muted text-sm d-block mb-2">Le Total Dépenses</span>

                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-black text-white text-lg rounded-circle">
                                    <i class="bi bi-graph-down-arrow"></i>
                                </div>
                            </div>
                        </div>
                        <div class=" mb-0 text-sm">
                            <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                <i class="bi bi-arrow-down me-1"></i> {{ $totalDepenses }} $
                            </span>
                            <span class="text-nowrap text-xs text-muted">Le montant Dépenses</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card shadow border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <span class="h6 font-semibold text-muted text-sm d-block mb-2">Le Total restant</span>

                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-warning text-white text-lg rounded-circle">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                            </div>
                        </div>
                        @php
                        $difference = $totalRevenus - $totalDepenses;
                        @endphp
                        <div class="mb-0 text-sm">
                            @if ($difference < 0) <span class="badge badge-pill bg-soft-danger text-danger me-2">
                                <i class="bi bi-arrow-down me-1"></i> {{ abs($difference) }} $
                                </span>
                                @else
                                <span class="badge badge-pill bg-soft-success text-success me-2">
                                    <i class="bi bi-arrow-up me-1"></i> {{ $difference }} $
                                </span>
                                @endif
                                <span class="text-nowrap text-xs text-muted">Le montant restant</span>
                        </div>

                    </div>

                </div>

            </div>



        </div>
    </div>
    <div class=" col-12">
    <div class="daily-expenses card">
        <div class="card-body text-center"> <!-- Ajout de la classe text-center pour centrer le contenu -->
            <h2 class="card-title">Dépenses par jour</h2>
            <canvas id="expenseChart"></canvas>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('expenseChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($dailyExpenses as $expense)
                '{{ $expense->day }}',
                @endforeach
            ],
            datasets: [{
                label: 'Montant total',
                data: [
                    @foreach($dailyExpenses as $expense)
                    {{ $expense->total_amount }},
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 5
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</main>

@endsection



@section('main')

<div class="container">
    <!-- <h3 align="center">Laravel 9 Live search using Jquery AJAX</h3><br /> -->
    <div class="row">

        <div class="d-flex justify-content-between mt-3">
            <h3 class="mb-3">Search : <span id="total_records"></span></h3>
        </div>


        <div class="col-12">

            <div class="form-group col-lg-3 col-md-6 col-9 mb-3  position-relative">
                <form action="{{ route('dashboard') }}" method="GET">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search"
                        value="{{ old('search') }}" />
                    <button type="submit" class="bi bi-search position-absolute me-0 btn-primary btn  border-0"
                        style="top: 50%; transform: translateY(-50%); right: 0;"></button>


                </form>
                <a href="{{route('dashboard')}}"> <button type="submit"
                        class="bi bi-x-lg position-absolute me-0 btn-danger btn border-0"
                        style="top: 50%; transform: translateY(-50%); left:105%;"></button></a>
            </div>

            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Transactions</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <!-- <th scope="col">id</th> -->

                                <th scope="col">transactions financières</th>
                                <th scope="col">Date</th>
                                <th scope="col">Prix</th>
                                <th scope="col">Category</th>

                                <th scope="col">Max Total</th>
                                <th scope="col">Prix ​​restant</th>
                                <th scope="col">Notification</th>



                                <!-- <th scope="col">change role</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr>
                                <!-- <td>{{ $transaction->id }}</td> -->
                                <td>{{(ucfirst( $transaction->type))}}</td>
                                <td>{{ $transaction->date}}</td>
                                <td>{{ $transaction->amount}} $</td>
                                <td>{{ $transaction->budget->category}}</td>
                                <td>{{ $transaction->budget->max_amount}} $</td>


                                <td>
                                    @if($transaction->type === 'revenus')
                                    {{ $transaction->budget->max_amount + $transaction->amount }} $
                                    @else
                                    {{ $transaction->budget->max_amount - $transaction->amount }} $
                                    @endif
                                </td>

                                <td>
    @php
        if ($transaction->type === 'dépenses') {
            $difference = $transaction->budget->max_amount - $transaction->amount;
            $notification = '';

            if ($difference <= 0) {
                $notification = 'Dépassement du montant maximal du budget !';

                $notificationColor = 'red';
            } elseif ($difference < 500) {
                $notification = 'Proche du montant maximal du budget !';
                $notificationColor = 'orange';
            } else {
                $notification = '' . $difference . ' $';
                $notificationColor = 'green';
            }
        } else {
            // Si le type n'est pas 'revenus', vous pouvez définir une notification par défaut
            $notification = 'Montant ajouté : +' . $difference . ' $';
            $notificationColor = 'green';
        }
    @endphp

    <span style="color: {{ $notificationColor }}" class="notification">{{ $notification }}</span>
</td>





                            </tr>
                            @empty
                            <tr>
                                <div class="text-center p-2 m-2" style="background-color: rgb(195, 195, 188)">
                                    <h1> No Transaction</h1>
                                </div>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="pagination ms-3 mt-0 mb-5">
            {{ $transactions->links() }}
        </div>

    </div>

</div>




@endsection
