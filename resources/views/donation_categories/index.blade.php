@extends('layouts.admin')

@section('content')
@section('title', 'Donation Categories')

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
            <h5 class="mx-1 mt-3">Donation Categories</h5>
            @can('donation_categories_create')
            <a href="{{ url('donation-categories/create') }}" class="btn btn-danger ms-auto m-2">Add Donation Category</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            @canany(['donation_categories_edit', 'donation_categories_delete', 'donation_categories_show'])
                            <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <span class="badge {{ $category->status == 0 ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $category->status == 0 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                @canany(['donation_categories_edit', 'donation_categories_delete', 'donation_categories_show'])
                                <td width="200px">
                                    @can('donation_categories_show')
                                    <a href="{{ url('donation-categories/show/' . $category->id) }}" class="text-primary px-3"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('donation_categories_edit')
                                    <a href="{{ url('donation-categories/edit/' . $category->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('donation_categories_delete')
                                    <a href="{{ url('donation-categories/delete/' . $category->id) }}" class="text-danger px-3" onclick="return confirm('Delete this Donation?')"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                                @endcanany

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No categories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
