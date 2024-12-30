@extends('layouts.app')

@section('content')
    <h2>Labels</h2>
    <div class="mb-3">
        <a href="{{ route('home') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
        <a href="{{ route('labels.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Create Label
        </a>
    </div>
    <table class="table mt-4">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($labels as $label)
            <tr>
                <td>{{ $label->id }}</td>
                <td>{{ $label->name }}</td>
                <td>
                    <a href="{{ route('labels.edit', $label->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('labels.destroy', $label->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
