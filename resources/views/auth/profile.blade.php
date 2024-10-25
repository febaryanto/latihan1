@extends('base')
@section('header')
<title>Data Pengguna</title>
@endsection
@section('content')
<div class="container content mt-3">
    <h2 class="mb-4">{{$user->name}}</h2>
    <p>{{$user->email}}</p>
    <ol>
        @foreach($user->bankAccounts as $bankAccount)
        <li>No. Rekening: <b>{{$bankAccount->account_number}}</b>
            ({{$bankAccount->bank_name}}) - {{$bankAccount->status}}
        </li>
        @endforeach
    </ol>
</div>
@endsection
@push('javascript')
@endpush