@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if(Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            <div class="card">
                @include('include.header')
                <div class="card-body">
                    <form action="{{ url('/hotel/address') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $address ? $address->id : '' }}">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" rows="8" id="mytextarea" name="address" placeholder="Enter your address">{{ $address ? $address->address : old('address') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
