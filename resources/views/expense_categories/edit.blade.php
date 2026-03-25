@extends('layouts.admin')

@section('content')
@section('title', 'Edit Expense Categories')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="mb-0">Edit Expense Category</h5>
        </div>

        <div class="card-body">
            <form action="{{ url('expense-categories/update/' . $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" placeholder="Name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Active</option>
                        <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-danger">Update</button>
                <a href="{{ url('expense-categories') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
