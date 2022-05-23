@extends('frontend.master')
@section('content')
    <div id="main">
        <div class="container mt-3">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <img src="{{ $room->image }}" height="100%" width="100%">
                    </div>
                    <div class="col-md-4">
                        <h3>{{ $room->title }}</h3><br/>
                        <span>Price : {{ $room->price }}</span><br/>
                        <span>Room type : {{ $room->room_type }}</span><br/>
                        <span>Description : {{ $room->description }}</span>
                        <hr/>
                        <div class="card">
                            <div class="card-header bg-success">
                                <h5 class="text-white">For Booking</h5>
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
                                <form action="{{ url('/room/booking') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter your name">
                                    <input type="hidden" name="id" class="form-control" value="{{ $room->id }}" >
                                    <label>Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter your phone">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter your email">
                                    <label>Start date</label>
                                    <input type="date" name="start_date" class="form-control">
                                    <label>End date</label>
                                    <input type="date" name="end_date" class="form-control">
                                    <input type="hidden" name="price" value="{{ $room->price }}" class="form-control">
                                    <button type="submit" class="btn btn-success btn-sm mt-3">Booking Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
