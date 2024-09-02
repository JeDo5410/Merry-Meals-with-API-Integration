@section('title')
    Delivery Status - Volunteer
@endsection

@extends('Users.Volunteer.layouts.app')

@section('content')
<div class="fh5co-services-section">
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="delivery-status">
                <div class="col-md-12 offset-md-0">
                    <div class="mt-5 p-4">
                        <h1 class="text-secondary text-center mb-5 display-5">
                            Delivery Status - Volunteer
                        </h1>
                        <div class="row">
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Member Name</th>
                                        <th>Member Address</th>
                                        <th>Restaurant</th>
                                        <th>Restaurant Address</th>
                                        <th>Order Date</th>
                                        <th>Order Time</th>
                                        <th>Rider</th>
                                        <th>Start Delivery Time</th>
                                        <th>Delivery Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deliveryData as $delivery)
                                    <tr>
                                        <td>{{ $delivery->id }}</td>
                                        <td>{{ $delivery->member_name }}</td>
                                        <td>{{ $delivery->member_address }}</td>
                                        <td>{{ $delivery->partner_restaurant_name }}</td>
                                        <td>{{ $delivery->partner_address }}</td>
                                        <?php 
                                        $str = $delivery -> created_at;
                                        $newstr = explode(" ", $str);
                                        $date = $newstr[0];
                                        $time = $newstr[1];
                                        ?>
                                        <td><?php echo $date;  ?></td>
                                        <td><?php echo $time;  ?></td>
                                        <td>
                                            <form action="{{ route('deliver#updateDelivery', $delivery->id) }}" method="GET" class="d-flex align-items-center">
                                                <input type="text" name="volunteer_name" value="{{ $delivery->volunteer_name }}" readonly class="form-control mr-2"/>
                                                <button type="submit" class="btn btn-primary">Accept</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('deliver#updateDelivery', $delivery->id) }}" method="GET" class="d-flex align-items-center">
                                                <input type="text" name="start_deliver_time" value="{{ $delivery->start_deliver_time }}" readonly class="form-control mr-2"/>
                                                <button type="submit" class="btn btn-success">Start</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{ route('deliver#updateDelivery', $delivery->id) }}" method="GET" class="d-flex align-items-center">
                                                <select name="delivery_status" class="form-control mr-2">
                                                    <option value=""></option>
                                                    <option value="Pick the meal">Pick up the meal</option>
                                                    <option value="On the way to destination">On the way to destination</option>
                                                    <option value="Arrived at destination">Arrived at destination</option>
                                                </select>
                                                <button type="submit" class="btn btn-warning">Send Status</button>
                                            </form>
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


