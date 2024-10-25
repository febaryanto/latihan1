@extends('base')
@section('header')
<title>Data Pengguna</title>
@endsection
@section('content')
<div class="container content mt-3">
    <h2 class="mb-4">Data Pengguna</h2>

    @include('notification')
    <!-- Search Form -->
    <div class="d-flex justify-content-end align-items-center mb-4">
        <!-- Search Form -->
        <form action="{{ route('user.index') }}" method="GET" class="d-flex me2">
            <div class="input-group">
                <input type="text" name="search" class="form-control"
                    placeholder="Cari Pengguna..." value="{{ $search }}">
                <button class="btn btn-primary" type="submit">Cari</button>
            </div>
            @if(request()->has('search'))
            <a href="{{ route('user.index') }}" class="btn btn-outlinesecondary ms-2">Refresh</a>
            @endif
        </form>
        &nbsp;
        <!-- Create User Button -->
        <a href="{{ route('user.create') }}" class="btn btn-success">Buat
            Pengguna</a>
    </div>
    <!-- Users Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Role</th>
                    <th class="text-center">Rekening</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="text-center">{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">{{ ucfirst($user->role) }}</td>
                    <td class="text-center"><a href="{{ route('user.bank-account.index', $user->id) }}" class="btn btn-sm btn-dark">Rekening Bank</a></td>
                    <td class="text-center">
                        <!-- Edit and Delete buttons (if needed) -->
                        <a href="{{ route('user.show', $user->id) }}"
                            class="btn btn-sm btn-info">Lihat</a>
                        <a href="{{ route('user.edit', $user->id) }}"
                            class="btn btn-sm btn-warning">Ubah</a>
                        <form action="{{ route('user.destroy', $user->id)}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Tindakan ini tidak dapat dibatalkan.')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Pengguna Tidak
                        Ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination Links -->
    <div class="d-flex justify-content-end align-items-center">
        <div>
            <!-- Pagination Links (Right) -->
            {{ $users->appends(['search' => $search])->links() }}
        </div>
    </div>
</div>
@endsection
@push('javascript')
@endpush