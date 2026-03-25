@extends('layouts.admin')

@section('content')
@section('title', 'Currencies')

<div class="container mt-4">

       @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('edit'))
        <div class="alert alert-success">{{ session('edit') }}</div>
        @elseif(session('delete'))
        <div class="alert alert-success">{{ session('delete') }}</div>
    @endif

    <div class="card shadow rounded">
        <div class="card-header d-flex">
            <h5 class="mx-1 mt-3">Currencies</h5>
            @can('currencies_create')
            <a href="{{ url('currencies/create') }}" class="btn btn-danger ms-auto m-2">Add new Currency</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Symbol</th>
                            @canany(['currencies_edit', 'currencies_delete', 'currencies_show'])
                            <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($currencies as $currency)
                            <tr>
                                <td>{{ $currency->id }}</td>
                                <td>{{ $currency->name }}</td>
                                <td>{{ $currency->code }}</td>
                                <td>{{ $currency->symbol }}</td>

                                @canany(['currencies_edit', 'currencies_delete', 'currencies_show'])
                                <td width="200px">
                                    @can('currencies_show')
                                    <a href="{{ url('currencies/show/' . $currency->id) }}" class="text-primary px-3"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('currencies_edit')
                                    <a href="{{ url('currencies/edit/' . $currency->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('currencies_delete')
                                    <a href="{{ url('currencies/delete/' . $currency->id) }}" class="text-danger px-3" onclick="return confirm('Delete this Currency?')"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                                @endcanany

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No currency found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
