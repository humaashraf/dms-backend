@extends('layouts.admin')

@section('content')
@section('title', 'Edit Donation')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit Donation</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('donations/update/' . $donation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="first_name" value="{{ old('first_name', $donation->first_name) }}" placeholder="First Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="last_name" value="{{ old('last_name', $donation->last_name) }}" placeholder="Last Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" value="{{ old('email', $donation->email) }}" placeholder="Email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="number" name="phone" value="{{ old('phone', $donation->phone) }}" placeholder="Phone" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">City</label>
                    <input type="text" name="city" value="{{ old('city', $donation->city) }}" placeholder="City" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" name="address" value="{{ old('address', $donation->address) }}" placeholder="Address" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" name="amount" value="{{ old('amount', $donation->amount) }}" placeholder="Amount" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" value="{{ old('date', \Carbon\Carbon::parse($donation->date)->format('Y-m-d')) }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method_id" class="form-control" required>
                        <option value="">Select Payment Method</option>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}"
                                {{ (old('payment_method_id', $donation->payment_method_id) == $method->id) ? 'selected' : '' }}>
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
                            <option value="{{ $category->id }}"
                                {{ (old('donation_category_id', $donation->donation_category_id) == $category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Bank Account</label>
                    <select name="bank_account_id" class="form-control" required>
                        <option value="">Select Bank Account</option>
                        @foreach($bankAccounts as $account)
                            <option value="{{ $account->id }}" {{ old('bank_account_id', $donation->bank_account_id) == $account->id ? 'selected' : '' }}>
                                {{ $account->account_title }} ({{ str_repeat('*', strlen($account->account_number) - 4) . substr($account->account_number, -4) }})
                            </option>
                        @endforeach
                    </select>
                </div>




                <button type="submit" class="btn btn-danger">Update</button>
                <a href="{{ url('donations') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
