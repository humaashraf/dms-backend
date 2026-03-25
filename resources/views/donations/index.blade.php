@extends('layouts.admin')

@section('content')
@section('title', 'Donations')

<div class="container mt-4">

       @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('edit'))
        <div class="alert alert-success">{{ session('edit') }}</div>
        @elseif(session('delete'))
        <div class="alert alert-success">{{ session('delete') }}</div>
    @endif

/

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


    <div class="card shadow rounded">
        <div class="card-header d-flex">
            <h5 class="mx-1 mt-3">Donations</h5>
            @can('donations_create')
            <a href="{{ url('donations/create') }}" class="btn btn-danger ms-auto m-2">Add new Donation</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Date</th>
                            <th>Donation Category</th>
                            <th>Bank Account</th>
                            @canany(['donations_edit', 'donations_delete', 'donations_show'])
                            <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                            <tr>
                                <td>{{ $donation->id }}</td>
                                <td>{{ $donation->first_name }}</td>
                                <td>{{ $donation->last_name }}</td>
                                <td>{{ $donation->email }}</td>
                                <td>{{ $donation->phone }}</td>
                                <td>{{ $donation->city }}</td>
                                <td>{{ $donation->address }}</td>
                                <td>{{ $donation->amount }}</td>
                                <td>{{ $donation->paymentMethod->name ?? 'N/A' }}</td>
                                {{-- <td>{{ $donation->date }}</td> --}}
                                <td>{{ $donation->date->format($dateFormat) }}</td>

                                <td>{{ $donation->category->name ?? 'N/A' }}</td>
                                <td>
                                    @if($donation->bankAccount)
                                        {{ $donation->bankAccount->account_title }}
                                        -
                                        {{ $donation->bankAccount->bank_name }}
                                        -
                                        {{ str_repeat('*', strlen($donation->bankAccount->account_number) - 4) . substr($donation->bankAccount->account_number, -4) }}
                                    @else
                                        N/A
                                    @endif
                                </td>


                                @canany(['donations_edit', 'donations_delete', 'donations_show'])
                                <td width="200px">
                                    @can('donations_show')
                                    <a href="{{ url('donations/show/' . $donation->id) }}" class="text-primary px-3"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('donations_edit')
                                    <a href="{{ url('donations/edit/' . $donation->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('donations_delete')
                                    <a href="{{ url('donations/delete/' . $donation->id) }}" class="text-danger px-3" onclick="return confirm('Delete this Donation?')"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                                @endcanany
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Donation found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
