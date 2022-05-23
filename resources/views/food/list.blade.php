@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <div class="card">
                @include('include.header')
            </div>
            <div class="row">
                <div class="col-md-8">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($foods as $key => $food)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td>{{ substr($food->name,0,15) }}</td>
                                <td>{{ $food->price }} BDT</td>
                                <td>
                                    <img src="{{ $food->image }}" height="30" width="80">
                                </td>
                                <td>
                                    <a href="{{ url('/food/delete/'.$food->id) }}" onclick="return confirm('Are you sure delete this information?')" class="btn btn-sm btn-danger">Del</a>
                                    <a href="{{ url('/food/edit/'.$food->id) }}" class="btn btn-sm btn-info">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Food</div>
                        <div class="card-body">
                            <form action="{{ url('/food/store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Food name">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="text" name="price" class="form-control" id="price" placeholder="Price">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Image</label>
                                    <input type="file" name="image" id="image">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
