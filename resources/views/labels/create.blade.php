@extends('layouts.app')

@section('content')
    <h2>Create Label</h2>
    <form action="{{ route('labels.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Label Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Create</button>
    </form>
@endsection
