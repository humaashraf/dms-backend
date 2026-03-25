@extends('layouts.admin')

@section('content')
@section('title', 'Create Donation')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Create Donation</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('donations/store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="number" name="phone" value="{{ old('phone') }}" placeholder="phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" value="{{ old('city') }}" placeholder="City" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Address" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="text" name="amount" value="{{ old('amount') }}" placeholder="Amount" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" value="{{ old('date') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method_id" class="form-control" required>
                        <option value="">Select Payment Method</option>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}" {{ old('payment_method_id') == $method->id ? 'selected' : '' }}>
                                {{ $method->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-3">
                    <label class="form-label">Donation Category</label>
                    <select name="donation_category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('donation_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
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






                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('donations') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
