@extends('layouts.admin')

@section('content')
@section('title', 'Expense Categories')

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
            <h5 class="mx-1 mt-3">Wire Transfers</h5>
            @can('wire_transfers_create')
            <a href="{{ url('wire-transfers/create') }}" class="btn btn-danger ms-auto m-2">Add Wire Transfer</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Remaining Amount</th>
                            <th>Bank</th>
                            <th>Status</th>
                            <th>Date</th>
                            @canany(['wire_transfers_edit', 'wire_transfers_delete', 'wire_transfers_show'])
                            <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transfers as $transfer)
                            <tr>
                                <td>{{ $transfer->id }}</td>
                                <td>{{ $transfer->name }}</td>
                                <td>{{ $transfer->amount }}</td>
                                <td>{{ $transfer->remaining_amount ?? 'N/A' }}</td>
                                <td>
                                    @if($transfer->bankAccount)
                                        {{ $transfer->bankAccount->account_title }}
                                        -
                                        {{ $transfer->bankAccount->bank_name }}
                                        -
                                        {{ str_repeat('*', strlen($transfer->bankAccount->account_number) - 4) . substr($transfer->bankAccount->account_number, -4) }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <span class="badge
                                        {{ $transfer->status == 0 ? 'bg-success' : ($transfer->status == 1 ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ $transfer->status == 0 ? 'Completed' : ($transfer->status == 1 ? 'Pending' : 'Failed') }}
                                    </span>


                                </td>
                                {{-- <td>{{ $transfer->date }}</td> --}}
                                <td>{{ $transfer->date->format($dateFormat) }}</td>

                                @canany(['wire_transfers_edit', 'wire_transfers_delete', 'wire_transfers_show'])
                                <td width="200px">
                                    @can('wire_transfers_show')
                                    <a href="{{ url('wire-transfers/show/' . $transfer->id) }}" class="text-primary px-3"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('wire_transfers_edit')
                                    <a href="{{ url('wire-transfers/edit/' . $transfer->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('wire_transfers_delete')
                                    <form action="{{ url('wire-transfers/delete/' . $transfer->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this Payment Method?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger px-3" style="border:none;">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </td>
                                @endcanany

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
