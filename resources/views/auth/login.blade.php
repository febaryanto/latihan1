@extends('base')
@section('header')
<title>Login</title>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <hr />
            <h4 class="text-center">Selamat Datang di Lingkungan Partai Laravel Perjuangan</h4>
            <hr />
            <h5 class="text-center">Silahkan Login</h5>
            <form action="{{ route('login') }}" method="POST">

                @csrf
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" value="{{old('email')}}">
                    @error('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div></br>
                <button type="submit" class="btn btn-primary pull-right">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('javascript')
@endpush