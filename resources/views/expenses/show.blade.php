@extends('layouts.admin')

@section('content')
@section('title', 'Show Expense')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Expense Details</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $expense->id }}
            </div>
            <div class="mb-3">
                <strong>Amount:</strong> {{ $expense->amount }}
            </div>
            <div class="mb-3">
                <strong>Date:</strong> {{ $expense->date }}
            </div>
            <div class="mb-3">
                <strong>Details:</strong> {{ $expense->details }}
            </div>
            <div class="mb-3">
                <strong>Receipt:</strong> {{ $expense->receipt }}
            </div>

            <a href="{{ url('expenses') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
