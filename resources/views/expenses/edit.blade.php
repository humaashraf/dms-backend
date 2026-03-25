@extends('layouts.admin')

@section('content')
@section('title', 'Edit Expense')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit Expense</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('expenses/update/' . $expense->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" value="{{ old('amount', $expense->amount) }}" class="form-control" required>
                </div>

                {{-- <div class="form-group">
                    <label for="wire_transfer_id">Wire Transfer</label>
                    <select name="wire_transfer_id" class="form-control">
                        <option value="">Select Wire Transfer</option>
                        @foreach($wireTransfers as $transfer)
                            <option value="{{ $transfer->id }}"
                                {{ $expense->wire_transfer_id == $transfer->id ? 'selected' : '' }}>
                                {{ $transfer->name }} (PKR {{ number_format($transfer->remaining_amount) }} remaining)
                            </option>
                        @endforeach
                    </select>
                        @error('amount')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div> --}}
                <div class="form-group">
                    <label for="wire_transfer_id">Wire Transfer</label>
                    <select name="wire_transfer_id" class="form-control">
                        <option value="">Select Wire Transfer</option>
                        {{-- @foreach($wireTransfers as $transfer)
                            <option value="{{ $transfer->id }}"
                                {{ $expense->wire_transfer_id == $transfer->id ? 'selected' : '' }}>
                                Name: {{ $transfer->name }}
                                @if($transfer->bankAccount)
                                    | Bank: {{ $transfer->bankAccount->account_title }}
                                @endif
                                | Remaining Amount: PKR {{ number_format($transfer->remaining_amount) }}
                            </option>
                        @endforeach --}}
                        @foreach($wireTransfers as $transfer)
                            @if($transfer->remaining_amount > 0)
                                <option value="{{ $transfer->id }}"
                                    {{ $expense->wire_transfer_id == $transfer->id ? 'selected' : '' }}>
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
                            <option value="{{ $cat->id }}" {{ old('expense_category_id', $expense->expense_category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($expense->date)->format('Y-m-d')) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Details</label>
                    <textarea name="details" class="form-control" rows="4">{{ old('details', $expense->details) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Receipt</label>
                    <input type="text" name="receipt" value="{{ old('receipt', $expense->receipt) }}" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-danger">Update</button>
                <a href="{{ url('expenses') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
