@extends('layouts.app')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Update Room</div>
            <div class="card-body">
                <form action="{{ url('/room/update/') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ $room->title }}" aria-describedby="emailHelp" placeholder="Title">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $room->id }}" aria-describedby="emailHelp" placeholder="Title">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" id="price" value="{{ $room->price }}" placeholder="Price">
                    </div>
                    <div class="mb-3">
                        <label for="room_type" class="form-label">Room type</label>
                        <input type="text" name="room_type" class="form-control" id="room_type" value="{{ $room->room_type }}" placeholder="Room type">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Room Details</label>
                        <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"> {{ $room->description }} </textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Image</label>
                        <img class="img-fluid d-none d-lg-block mb-3" style="height: 100px" alt="image" src="{{ url($room->image) }}" />
                        <input type="file" name="image" id="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Room</button>
                </form>
            </div>
        </div>
    </div>
@endsection
