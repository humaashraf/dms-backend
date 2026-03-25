@extends('layouts.admin')

@section('content')
@section('title', 'Edit Currencies')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit Currencies</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('currencies/update/' . $currency->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $currency->name) }}" placeholder="Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" value="{{ old('code', $currency->code) }}" placeholder="code" class="form-control" required>
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">symbol</label>
                    <input type="text" name="symbol" value="{{ old('symbol', $currency->symbol) }}" placeholder="symbol" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-danger">Update</button>
                <a href="{{ url('currencies') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
