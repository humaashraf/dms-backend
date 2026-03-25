@extends('layouts.admin')

@section('content')
@section('title', 'Add Expense')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Add Expense</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('expenses/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" value="{{ old('amount') }}" placeholder="Amount" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="wire_transfer_id">Wire Transfer</label>
                    <select name="wire_transfer_id" class="form-control">
                        <option value="">Select Wire Transfer</option>
                        @foreach($wireTransfers as $transfer)
                            @if($transfer->remaining_amount > 0)
                                <option value="{{ $transfer->id }}">
                                    Name: {{ $transfer->name }}
                                    @if($transfer->bankAccount)
                                        | Bank: {{ $transfer->bankAccount->account_title }}
                                    @endif
                                    | Remaining Amount: PKR {{ number_format($transfer->remaining_amount) }}
                                </option>
                            @endif
                        @endforeach
                    </select>

                    @error('amount')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Expense Category</label>
                    <select name="expense_category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" value="{{ old('date') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Details</label>
                    <textarea name="details" class="form-control" rows="4">{{ old('details') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Receipt</label>
                    <input type="text" name="receipt" value="{{ old('receipt') }}" placeholder="Receipt" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('expenses') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
