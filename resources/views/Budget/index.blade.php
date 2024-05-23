@extends('Dashboard.dashboard')


@section('main')

<div class="container">
    <!-- <h3 align="center">Laravel 9 Live search using Jquery AJAX</h3><br /> -->
    <div class="row">

        <div class="d-flex justify-content-between mt-3 my-5">
            <h3 class="mb-3">Search  : <span id="total_records"></span></h3>
            <a href="{{route('budget.create')}}" class="text-end btn btn-dark">Create budget </a>
        </div>


        <div class="col-12">

        <div class="form-group col-lg-3 col-md-6 col-9 mb-3  position-relative">
                <form action="{{ route('budget.index') }}" method="GET">
                    <input type="text" name="search" id="search" class="form-control" placeholder="Search"
                        value="{{ old('search') }}" />
                    <button type="submit" class="bi bi-search position-absolute me-0 btn-primary btn  border-0"
                        style="top: 50%; transform: translateY(-50%); right: 0;"></button>


                </form>
                <a href="{{route('budget.index')}}"> <button type="submit"
                        class="bi bi-x-lg position-absolute me-0 btn-danger btn border-0"
                        style="top: 50%; transform: translateY(-50%); left:105%;"></button></a>
            </div>

            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">User</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">category</th>
                                <th scope="col">max-amound</th>
                                <th scope="col">name</th>
                                <th scope="col">action</th>

                                <!-- <th scope="col">change role</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($budgets as $budget)
                            <tr>
                                <td >{{ $budget->id }}</td>
                                <td>{{ $budget->category }}</td>
                                <td>{{ $budget->max_amount}}</td>
                                <td>{{ $budget->user->name}}</td>


                                <td class="d-flex gap-2 ">
                                    <a href="{{route('budget.edit',$budget->id)}}"> <button
                                            class="btn btn-warning py-2 px-3"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="20" height="20" fill="currentColor" class="bi bi-pencil-square"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd"
                                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg></button></a>
                                    <form action="{{route('budget.destroy',$budget->id)}}" method='post'>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger px-3 py-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="20" height="20" fill="currentColor" class="bi bi-trash3"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                            </svg></button>
                                    </form>



                                </td>
                            </tr>
                            @empty
                            <tr>
                                <div class="text-center p-2 m-2" style="background-color: rgb(195, 195, 188)">
                                    <h1> No Budget</h1>
                                </div>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="pagination ms-3 mt-0 mb-5">
                {{ $budgets->links() }}
            </div>
        </div>

    </div>

</div>




@endsection
