@extends('Users.Member.layouts.app')

@section('title', 'Order Details - Member')

@section('content')
<div class="container-fluid py-4">
    <h1 class="text-primary text-center mb-5">Order Details</h1>

    <!-- Latest Order and Delivery Status -->
    @if($orderData)
    <div class="card shadow mb-5">
        <div class="card-header bg-primary text-white">
            <h2 class="h4 mb-0">Latest Order</h2>
        </div>
        <div class="card-body">
            <div class="mb-4">
                <a href="{{ route('member#viewAllMenu') }}" class="btn btn-primary btn-md shadow-sm">Order New Meal</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Partner</th>
                            <th>Meal</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Preparation</th>
                            <th>Rider</th>
                            <th>Status</th>
                            <th>Action</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $orderData->id }}</td>
                            <td>{{ $orderData->order_menu_restaurant }}</td>
                            <td>{{ $orderData->order_menu_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($orderData->created_at)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($orderData->created_at)->format('H:i') }}</td>
                            <td><span class="badge badge-pill badge-info">{{ $orderData->order_cooking_status }}</span></td>
                            <td>{{ $deliverData->volunteer_name ?: 'Not assigned' }}</td>
                            <td><span class="badge badge-pill badge-{{ $orderData->order_received_status == 'Received' ? 'success' : 'warning' }}">{{ $orderData->order_received_status }}</span></td>
                            <td>
                                @if($orderData->order_received_status != 'Received')
                                    <form id="receiveForm" action="{{ route('member#updateMemberOrder', $orderData->id) }}" method="GET">
                                        <input type="hidden" name="order_received_status" value="Received">
                                        <button id="receiveButton" type="submit" class="btn btn-success shadow-sm">Confirm Receipt</button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                @if($orderData->order_received_status == 'Received')
                                    @if($orderData->feedback)
                                        <a href="{{ route('feedback.show', $orderData->id) }}" class="btn btn-info shadow-sm">View Feedback</a>
                                    @else
                                        <a href="{{ route('feedback.create', $orderData->id) }}" class="btn btn-warning shadow-sm">Give Feedback</a>
                                    @endif
                                @else
                                    <span class="text-muted">Not yet received</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- All Orders -->
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h2 class="h4 mb-0">Order History</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No.</th>
                            <th>Partner</th>
                            <th>Meal</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->order_menu_restaurant }}</td>
                            <td>{{ $order->order_menu_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('H:i') }}</td>
                            <td><span class="badge badge-pill badge-{{ $order->order_received_status == 'Received' ? 'success' : 'warning' }}">{{ $order->order_received_status }}</span></td>
                            <td>
                                @if($order->order_received_status == 'Received')
                                    @if($order->feedback)
                                        <a href="{{ route('feedback.show', $order->id) }}" class="btn btn-info shadow-sm">View Feedback</a>
                                    @else
                                        <a href="{{ route('feedback.create', $order->id) }}" class="btn btn-warning shadow-sm">Give Feedback</a>
                                    @endif
                                @else
                                    <span class="text-muted">Not yet received</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .badge {
        font-size: 0.9em;
    }
    .btn {
        font-weight: bold;
        padding: 0.5rem 1rem;
    }
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
    }
    .shadow-sm {
        box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
    }
</style>
@endsection