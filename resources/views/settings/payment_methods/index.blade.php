@extends('layouts.admin')

@section('content')
@section('title', 'Payment Methods')

<div class="container mt-4">

       @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('edit'))
        <div class="alert alert-success">{{ session('edit') }}</div>
        @elseif(session('delete'))
        <div class="alert alert-success">{{ session('delete') }}</div>
        @elseif(session('error'))
        <div class="alert alert-warning">{{ session('error') }}</div>
    @endif

    <div class="card shadow rounded">
        <div class="card-header d-flex">
            <h5 class="mx-1 mt-3">Payment Methods</h5>
            @can('payment_methods_create')
            <a href="{{ url('payment-methods/create') }}" class="btn btn-danger ms-auto m-2">Add payment Method</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            @canany(['payment_methods_edit', 'payment_methods_delete'])
                            <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($methods as $method)
                            <tr>
                                <td>{{ $method->id }}</td>
                                <td>{{ $method->name }}</td>

                                @canany(['payment_methods_edit', 'payment_methods_delete'])
                                <td width="200px">
                                    @can('payment_methods_edit')
                                    <a href="{{ url('payment-methods/edit/' . $method->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('payment_methods_delete')
                                    <a href="{{ url('payment-methods/delete/' . $method->id) }}" class="text-danger px-3" onclick="return confirm('Delete this Payment Method?')"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                                @endcanany

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No methods found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
