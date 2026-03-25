@extends('layouts.admin')

@section('content')
@section('title', 'Bank Account')

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
            <h5 class="mx-1 mt-3">Bank Accounts</h5>
            @can('bank_accounts_create')
            <a href="{{ url('bank-accounts/create') }}" class="btn btn-danger ms-auto m-2">Add Bank Account</a>
            @endcan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle text-center mb-0">
                    <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Account Title</th>
                            <th>Account Number</th>
                            <th>Bank Name</th>
                            <th>Balance</th>
                            <th>Status</th>
                            @canany(['bank_accounts_edit', 'bank_accounts_delete', 'bank_accounts_show'])
                            <th>Actions</th>
                            @endcanany
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bankAccounts as $account)
                            <tr>
                                <td>{{ $account->id }}</td>
                                <td>{{ $account->account_title }}</td>
                                <td>{{ $account->account_number }}</td>
                                <td>{{ $account->bank_name }}</td>
                                <td>{{ $account->balance }}</td>
                                <td>
                                    <span class="badge {{ $account->status == 0 ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $account->status == 0 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>

                                @canany(['bank_accounts_edit', 'bank_accounts_delete', 'bank_accounts_show'])
                                <td width="200px">
                                    @can('bank_accounts_show')
                                    <a href="{{ url('bank-accounts/show/' . $account->id) }}" class="text-primary px-3"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('bank_accounts_edit')
                                    <a href="{{ url('bank-accounts/edit/' . $account->id) }}" class="text-success px-3"><i class="fas fa-pen-to-square"></i></a>
                                    @endcan
                                    @can('bank_accounts_delete')
                                    <a href="{{ url('bank-accounts/delete/' . $account->id) }}" class="text-danger px-3" onclick="return confirm('Delete this Account?')"><i class="fas fa-trash-alt"></i></a>
                                    @endcan
                                </td>
                                @endcanany

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No bank account found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
