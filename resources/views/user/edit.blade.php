@extends('base')

@section('header')
<title>Ubah Pengguna</title>
@endsection

@section('content')
<div class="container content mt-3">
    <h2 class="mb-4">Ubah Pengguna</h2>
    @include('notification')

    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This tells Laravel it's a PUT request for updating -->
        <div class="mb-5 mt-3">
            <div class="card">
                <div class="card-body">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <!-- Password (Optional) -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru (Biarkan kosong jika tidak mengganti password)</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <!-- Password Confirmation (Optional) -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation">
                    </div>

                    <!-- Role (Radio Buttons) -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="admin" value="admin"
                                {{ old('role', $user->role) == 'admin' ? 'checked' : '' }}>
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="role" id="user" value="user"
                                {{ old('role', $user->role) == 'user' ? 'checked' : '' }}>
                            <label class="form-check-label" for="user">User</label>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Penguna</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('javascript')
@endpush