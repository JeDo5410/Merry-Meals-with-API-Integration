@section('title')
    Order Status
@endsection

@extends('Users.Admin.layouts.app')

@section('content')
<div class="fh5co-services-section">
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="delivery-status">
                <div class="col-md-12 offset-md-0">
                    <div class="mt-5 p-4">
                        <h1 class="text-secondary text-center mb-5 display-5">
                            Deliveries Status
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
                                        <td>{{ $order ->id }}</td>
                                        <td>{{ $order ->member_name }}</td>
                                        <td>{{ $order ->order_menu_name }}</td>
                                        <?php 
                                        $str = $order ->created_at;
                                        $newstr = explode(" ", $str);
                                        $date = $newstr[0];
                                        $time = $newstr[1];
                                        ?>
                                        <td><?php echo $date;  ?></td>
                                        <td><?php echo $time;  ?></td>
                                        <td>
                                            {{ $order ->start_cooking_time }}
                                        </td>
                                        <td>
                                            {{ $order ->order_cooking_status }}
                                        </td>
                                        <td>
                                            {{ $order ->order_received_status}}
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