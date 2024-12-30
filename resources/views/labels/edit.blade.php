@extends('layouts.app')

@section('content')
    <h2>Edit Label</h2>
    <form action="{{ route('labels.update', $label->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Label Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $label->name }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
@endsection
