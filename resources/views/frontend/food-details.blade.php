@extends('frontend.master')
@section('content')
    <div id="main">
        <div class="container mt-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <img src="{{ $food->image }}" height="100%" width="100%">
                    </div>
                    <div class="col-md-4">
                        <h3>{{ $food->name }}</h3><br/>
                        <span>Price : {{ $food->price }} BDT</span><br/>
                        <span>Description : {{ $food->description }}</span>
                        <hr/>
                        <div class="card">
                            <div class="card-header bg-success">
                                <h5 class="text-white">For Order</h5>
                            </div>
                            <div class="card-body">
                                @if(Session::has('success'))
                                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ url('/food/order') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name">
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter your phone">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                    <label>Select Payment method</label>
                                    <select class="form-control" name="payment_method">
                                        <option selected disabled>--- Select a method ---</option>
                                        <option value="bkash">Bkash</option>
                                        <option value="rocket">Rocket</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="cash">Cash on delivery</option>
                                    </select>
                                    <input type="hidden" name="price" value="{{ $food->price }}" class="form-control">
                                    <button type="submit" class="btn btn-success btn-sm mt-3">Order</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
