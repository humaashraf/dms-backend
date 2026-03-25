@extends('layouts.admin')

@section('content')
@section('title', 'Currencies')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Curencies</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>ID:</strong> {{ $currency->id }}
            </div>
            <div class="mb-3">
                <strong>Name:</strong> {{ $currency->name }}
            </div>
            <div class="mb-3">
                <strong>Code:</strong> {{ $currency->code }}
            </div>
            <div class="mb-3">
                <strong>Symbol:</strong> {{ $currency->symbol }}
            </div>

            <a href="{{ url('currencies') }}" class="btn btn-secondary mt-3">Back to List</a>
        </div>
    </div>
</div>
@endsection
