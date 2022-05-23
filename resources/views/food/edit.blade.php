@extends('layouts.app')

@section('content')
    <div class="container">
   <div class="col-md-12">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Update Food</div>
            <div class="card-body">
                <form action="{{ url('/food/update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $food->name }}" placeholder="Food name">
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="id" name="id" value="{{ $food->id }}">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" id="price" value="{{ $food->price }}" placeholder="Price">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description">{{ $food->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Image</label>
                        <img class="img-fluid d-none d-lg-block mb-3" style="height: 100px" alt="image" src="{{ url($food->image) }}" />
                        <input type="file" name="image" id="image">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
