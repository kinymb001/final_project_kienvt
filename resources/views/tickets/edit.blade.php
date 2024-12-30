@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Ticket</h2>

        <!-- Hiển thị thông báo thành công hoặc lỗi nếu có -->
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @elseif(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('tickets.update', $ticket) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $ticket->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $ticket->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>
                <select class="form-control" id="priority" name="priority" required>
                    <option value="low" {{ old('priority', $ticket->priority) == 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', $ticket->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority', $ticket->priority) == 'high' ? 'selected' : '' }}>High</option>
                    <option value="critical" {{ old('priority', $ticket->priority) == 'critical' ? 'selected' : '' }}>Critical</option>
                </select>
            </div>

            <div class="form-group">
                <label for="categories">Categories</label>
                <select class="form-control" id="categories" name="categories[]" multiple required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ in_array($category->id, old('categories', $ticket->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="labels">Labels</label>
                <select class="form-control" id="labels" name="labels[]" multiple required>
                    @foreach($labels as $label)
                        <option value="{{ $label->id }}" {{ in_array($label->id, old('labels', $ticket->labels->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $label->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Ticket</button>
        </form>
    </div>
@endsection
