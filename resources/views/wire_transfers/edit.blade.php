@extends('layouts.admin')

@section('content')
@section('title', 'Edit Wire Transfer')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit Wire Transfer</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('wire-transfers/update/' . $transfer->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $transfer->name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" value="{{ old('amount', $transfer->amount) }}" class="form-control" required>
                    @error('amount')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Bank Account</label>
                    <select name="bank_account_id" class="form-control" required>
                        <option value="">Select Bank Account</option>
                        @foreach($bankAccounts as $account)
                            <option value="{{ $account->id }}"
                                {{ old('bank_account_id', $transfer->bank_account_id) == $account->id ? 'selected' : '' }}>
                                {{ $account->account_title }} ({{ str_repeat('*', strlen($account->account_number) - 4) . substr($account->account_number, -4) }})
                            </option>
                        @endforeach
                    </select>
                    @error('bank_account_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="mb-3">
                    <label class="form-label">Bank Account</label>
                    <div class="form-control">{{ $transfer->bankAccount->account_title ?? 'N/A' }} -
                                               ({{ str_repeat('*', strlen($transfer->bankAccount->account_number) - 4) . substr($transfer->bankAccount->account_number, -4) }})</div>
                </div> --}}

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($transfer->date)->format('Y-m-d')) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="0" {{ old('status', $transfer->status) == '0' ? 'selected' : '' }}>Completed</option>
                        <option value="1" {{ old('status', $transfer->status) == '1' ? 'selected' : '' }}>Pending</option>
                        <option value="2" {{ old('status', $transfer->status) == '2' ? 'selected' : '' }}>Faild</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ url('wire-transfers') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
