@extends('base')

@section('header')
<title>Lihat Pengguna</title>
@endsection

@section('content')
<div class="container content mt-3">
    <h2 class="mb-4">Lihat Pengguna</h2>
    @include('notification')
    <div class="mb-5 mt-3">
        <div class="card">
            <div class="card-body">
                <!-- User Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                </div>

                <!-- User Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                </div>

                <!-- User Role -->
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" class="form-control" id="role" value="{{ ucfirst($user->role) }}"
                        readonly>
                </div>

                <!-- Back Button -->

            </div>
            <div class="card-footer text-end">
                <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Ubah Pengguna</a>

            </div>
        </div>
    </div>
</div>
@endsection

@push('javascript')
@endpush