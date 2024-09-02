@extends('Users.Member.layouts.app')

@section('title', 'Give Feedback')

@section('content')
<div class="container mt-5 pt-5 pb-5"> <!-- Added pt-4 and pb-4 for padding top and bottom -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Give Feedback for Order #{{ $order->id }}</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('feedback.store') }}">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">

                        <div class="form-group row justify-content-center">
                            <label for="rating" class="col-md-2 col-form-label text-md-right">Rating</label>
                            <div class="col-md-6">
                                <select id="rating" name="rating" class="form-control" required>
                                    <option value="">Select a rating</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="3">3 - Good</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row justify-content-center">
                            <label for="comments" class="col-md-2 col-form-label text-md-right">Comments</label>
                            <div class="col-md-6">
                                <textarea id="comments" name="comments" class="form-control" rows="4"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row justify-content-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Submit Feedback
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
