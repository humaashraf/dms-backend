@extends('layouts.admin')

@section('content')
@section('title', 'Show Bank Account')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Show Bank Account Details</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $account->id }}
            </div>
            <div class="mb-3">
                <strong>Account Title:</strong> {{ $account->account_title }}
            </div>
            <div class="mb-3">
                <strong>Account Number:</strong> {{ $account->account_number }}
            </div>
            <div class="mb-3">
                <strong>Bank Name:</strong> {{ $account->bank_name }}
            </div>
            <div class="mb-3">
                <strong>Balance:</strong> {{ $account->balance }}
            </div>
            <div class="mb-3">
                <strong>Status:</strong>
                <span class="badge {{ $account->status == 0 ? 'bg-success' : 'bg-secondary' }}">
                    {{ $account->status == 0 ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <a href="{{ url('bank-accounts') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
