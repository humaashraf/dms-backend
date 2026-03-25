@extends('layouts.admin')

@section('content')
@section('title', 'Expenses')

<div class="container mt-4">

       @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('edit'))
        <div class="alert alert-success">{{ session('edit') }}</div>
        @elseif(session('delete'))
        <div class="alert alert-success">{{ session('delete') }}</div>
    @endif

    <div class="card shadow rounded">
        <div class="card-header d-flex">
            <h5 class="mx-1 mt-3">Expenses</h5>
            @can('expenses_create')
            <a href="{{ url('expenses/create') }}" class="btn btn-danger ms-auto m-2">Add new Expense</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Bank</th>
                            <th>Category</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Details</th>
                            <th>Receipt</th>
                            @canany(['expenses_edit', 'expenses_delete', 'expenses_show'])
                            <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($expenses as $expense)
                            <tr>
                                <td>{{ $expense->id }}</td>
                                <td>
                                    @if($expense->wireTransfer)
                                        Name: {{ $expense->wireTransfer->name }}

                                        @if($expense->wireTransfer->bankAccount)
                                            <br>
                                            <small class="text-muted">
                                            Bank: {{ $expense->wireTransfer->bankAccount->account_title }}
                                            </small>
                                        @endif

                                        <br>
                                        <small class="text-muted">
                                            Remaining Amount: {{ number_format($expense->wireTransfer->remaining_amount) }}
                                        </small>
                                    @else
                                        N/A
                                    @endif
                                </td>


                                <td>{{ $expense->category->name ?? 'N/A' }}</td>
                                <td>{{ $expense->amount }}</td>
                                {{-- <td>{{ $expense->date }}</td> --}}
                                <td>{{ $expense->date->format($dateFormat) }}</td>
                                <td>{{ $expense->details }}</td>
                                <td>{{ $expense->receipt }}</td>

                                @canany(['expenses_edit', 'expenses_delete', 'expenses_show'])
                                <td width="200px">
                                    @can('expenses_show')
                                    <a href="{{ url('expenses/show/' . $expense->id) }}" class="text-primary px-3"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('expenses_edit')
                                    <a href="{{ url('expenses/edit/' . $expense->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('expenses_delete')
                                    <a href="{{ url('expenses/delete/' . $expense->id) }}" class="text-danger px-3" onclick="return confirm('Delete this Expense?')"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                                @endcanany

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No expenses found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
