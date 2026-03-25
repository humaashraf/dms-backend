@extends('layouts.admin')

@section('content')
@section('title', 'Show Wire Transfer')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Wire Transfer Details</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $transfer->id }}
            </div>
            <div class="mb-3">
                <strong>Name:</strong> {{ $transfer->name }}
            </div>
            <div class="mb-3">
                <strong>Amount:</strong> {{ $transfer->amount }}
            </div>
            <div class="mb-3">
                <strong>Remaining Amount:</strong> {{ $transfer->remaining_amount }}
            </div>
            <div class="mb-3">
                <strong>Bank Account:</strong> {{ $transfer->bankAccount->account_title ?? 'N/A' }} -
                                               ({{ str_repeat('*', strlen($transfer->bankAccount->account_number) - 4) . substr($transfer->bankAccount->account_number, -4) }})
            </div>
            <div class="mb-3">
                <strong>Status:</strong>
                <span class="badge
                    {{ $transfer->status == 0 ? 'bg-success' : ($transfer->status == 1 ? 'bg-warning text-dark' : 'bg-danger') }}">
                    {{ $transfer->status == 0 ? 'Completed' : ($transfer->status == 1 ? 'Pending' : 'Failed') }}
                </span>
            </div>
            <div class="mb-3">
                <strong>Date:</strong> {{ $transfer->date }}
            </div>

            <a href="{{ url('wire-transfers') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
