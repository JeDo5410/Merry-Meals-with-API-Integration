@section('title')
    Order Status - Partner
@endsection

@extends('Users.Partner.layouts.app')

@section('content')
<div class="fh5co-services-section">
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="delivery-status">
                <div class="col-md-12 offset-md-0">
                    <div class="mt-5 p-4">
                        <h1 class="text-secondary text-center mb-5 display-5">
                            Order Status - Partner
                        </h1>
                        <div class="row">
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Member Name</th>
                                        <th>Meal Name</th>
                                        <th>Order Date</th>
                                        <th>Order Time</th>
                                        <th>Start Cooking Time</th>
                                        <th>Menu Status</th>
                                        <th>Order Received Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderData as $order)
                                    <tr>
                                        <td>{{ $order -> id }}</td>
                                        <td>{{ $order -> member_name }}</td>
                                        <td>{{ $order -> order_menu_name }}</td>
                                        <?php 
                                        $str = $order -> created_at;
                                        $newstr = explode(" ", $str);
                                        $date = $newstr[0];
                                        $time = $newstr[1];
                                        ?>
                                        <td><?php echo $date;  ?></td>
                                        <td><?php echo $time;  ?></td>
                                        <td>
                                            <form action="{{ route('order#updateOrder', $order ->id) }}" method="GET">
                                            <input type="text" name="start_cooking_time" value="{{ $order -> start_cooking_time }}" readonly/>
                                            <button  type="submit" class="btn btn-primary">Start</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('order#updateOrder', $order ->id) }}" method="GET">
                                            {{-- <input type="text" name="order_cooking_status" value="{{ $order -> order_cooking_status }}" /> --}}
                                            <select name="order_cooking_status" value="{{ $order -> order_cooking_status }}">
                                                <option value=""></option>
                                                <option value="Being prepared">Being prepared</option>
                                                <option value="Ready to deliver">Ready to delivery</option>
                                            </select>
                                            <button  type="submit" class="btn btn-primary">Send Status</button>
                                            </form>
                                        </td>
                                        <td>
                                            {{ $order -> order_received_status}}
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection