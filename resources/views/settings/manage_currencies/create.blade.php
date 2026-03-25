@extends('layouts.admin')

@section('content')
@section('title', 'Create Currency')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Create Currency</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('currencies/store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Code</label>
                    <input type="text" name="code" value="{{ old('code') }}" placeholder="Code" class="form-control" required>
                    @error('code')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Symbol</label>
                    <input type="text" name="symbol" value="{{ old('symbol') }}" placeholder="Symbol" class="form-control" required>
                </div>



                <button type="submit" class="btn btn-danger">Create</button>
                <a href="{{ url('currencies') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
