@extends('layouts.admin')

@section('content')
@section('title', 'Show Donations')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Donation Details</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $donation->id }}
            </div>
            <div class="mb-3">
                <strong>First Name:</strong> {{ $donation->first_name }}
            </div>
            <div class="mb-3">
                <strong>Last Name:</strong> {{ $donation->last_name }}
            </div>
            <div class="mb-3">
                <strong>Email:</strong> {{ $donation->email }}
            </div>
            <div class="mb-3">
                <strong>Phone:</strong> {{ $donation->phone }}
            </div>
            <div class="mb-3">
                <strong>City:</strong> {{ $donation->city }}
            </div>
            <div class="mb-3">
                <strong>Address:</strong> {{ $donation->address }}
            </div>
            <div class="mb-3">
                <strong>Amount:</strong> {{ $donation->amount }}
            </div>
            <div class="mb-3">
                <strong>Date:</strong> {{ $donation->date }}
            </div>
            <div class="mb-3">
                <strong>Donation Category:</strong> {{ $donation->category->name ?? 'N/A' }}
            </div>
            <div class="mb-3">
                <strong>Bank Account:</strong> {{ $donation->bankAccount->account_title ?? 'N/A' }} -
                                               ({{ str_repeat('*', strlen($donation->bankAccount->account_number) - 4) . substr($donation->bankAccount->account_number, -4) }})
            </div>



            <a href="{{ url('donations') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
