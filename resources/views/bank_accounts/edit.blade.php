@extends('layouts.admin')

@section('content')
@section('title', 'Bank Accounts')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit Bank Account</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('bank-accounts/update/' . $account->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Account Title</label>
                    <input type="text" name="account_title" value="{{ old('account_title', $account->account_title) }}" placeholder="Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Account Number</label>
                    <input type="number" name="account_number" value="{{ old('account_number', $account->account_number) }}" placeholder="Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name', $account->bank_name) }}" placeholder="Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Balance</label>
                    <input type="text" name="balance" value="{{ old('balance', $account->balance) }}" placeholder="Name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="0" {{ old('status', $account->status) == '0' ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ old('status', $account->status) == '1' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-danger">Update</button>
                <a href="{{ url('bank-accounts') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
