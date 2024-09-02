@extends('Users.Member.layouts.app')

@section('title', 'Feedback Details')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Feedback for Order #{{ $feedback->order_id }}</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <p><strong>Rating:</strong> {{ $feedback->rating }}/5</p>
                    <p><strong>Comments:</strong> {{ $feedback->comments ?: 'No comments provided.' }}</p>

                    <a href="{{ route('member#index') }}" class="btn btn-primary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection