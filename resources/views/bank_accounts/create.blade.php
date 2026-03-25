@extends('layouts.admin')

@section('content')
@section('title', 'Create Bank Account')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Create Bank Account</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('bank-accounts/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Account Title</label>
                    <input type="text" name="account_title" value="{{ old('account_title') }}" placeholder="Account Title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Account Number</label>
                    <input type="number" name="account_number" value="{{ old('account_number') }}" placeholder="Account number" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Bank Name</label>
                    <input type="text" name="bank_name" value="{{ old('bank_name') }}" placeholder="Bank Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Balance</label>
                    <input type="text" name="balance" value="0" placeholder="Balance" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">Select Status</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('bank-accounts') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
