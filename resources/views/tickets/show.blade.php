@extends('layouts.app')

@section('content')
    <h2>Ticket Details</h2>
    <div class="card">
        <div class="card-header">
            <strong>{{ $ticket->title }}</strong>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $ticket->description }}</p>
            <p><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</p>
            <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
            <p><strong>Created By:</strong> {{ $ticket->creator->name }}</p>
        </div>
    </div>

    <h4 class="mt-4">Comments</h4>
    <div class="card mt-2">
        <div class="card-body">
            @foreach ($ticket->comments as $comment)
                <div class="mb-2">
                    <strong>{{ $comment->user->name }}</strong> ({{ $comment->created_at->format('Y-m-d H:i') }}):
                    <p>{{ $comment->content }}</p>
                </div>
                <hr>
            @endforeach

            <h5>Add a Comment</h5>
            <form action="{{ route('tickets.addComment', $ticket->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="content" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Add Comment</button>
            </form>
        </div>
    </div>

    <a href="{{ route('tickets.index') }}" class="btn btn-secondary mt-3">Back to Tickets</a>
@endsection
