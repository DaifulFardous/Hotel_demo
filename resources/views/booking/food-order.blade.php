@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                @include('include.header')
            </div>
            <div class="card-header">
                <h4>All Food Order</h4>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Price</th>
                            <th scope="col">Payment Method</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($foodOrder as $key => $order)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->price }} BDT</td>
                                <td>{{ ucfirst($order->payment_method) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
