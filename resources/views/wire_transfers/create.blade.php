@extends('layouts.admin')

@section('content')
@section('title', 'Create Wire Transfer')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Create Wire Transfer</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('wire-transfers/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" value="{{ old('amount') }}" placeholder="Amount" class="form-control" required>
                        @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Bank Account</label>
                    <select name="bank_account_id" class="form-control" required>
                        <option value="">Select Bank Account</option>
                        @foreach($bankAccounts as $account)
                            <option value="{{ $account->id }}" {{ old('bank_account_id') == $account->id ? 'selected' : '' }}>
                                {{ $account->account_title }} ({{ str_repeat('*', strlen($account->account_number) - 4) . substr($account->account_number, -4) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" value="{{ old('date') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Completed</option>
                        <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Pending</option>
                        <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Faild</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('wire-transfers') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
