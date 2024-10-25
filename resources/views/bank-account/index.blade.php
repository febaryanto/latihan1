@extends('base')

@section('header')
<title>Data Rekening {{ $userData->name }}</title>
@endsection

@section('content')
<div class="container content mt-3">
    <h2 class="mb-4">Data Rekening {{ $userData->name }}</h2>
    @include('notification')

    <!-- Search Form -->
    <div class="d-flex justify-content-end align-items-center mb-4">

        <!-- Create User Button -->
        <div class="text-end">
            <a href="{{ route('user.index') }}" class="btn btn-secondary mr-2">Kembali</a>
            <a href="{{ route('user.bank-account.create', $userData->id) }}" class="btn btn-success">Buat Rekening</a>
        </div>
    </div>

    <!-- Users Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="text-center">Bank</th>
                    <th class="text-center">Rekening</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($userData['bankAccounts'] as $bankAccount)
                <tr>
                    <td class="text-center">{{ $bankAccount->bank_name }}</td>
                    <td class="text-center">{{ $bankAccount->account_number }}</td>
                    <td class="text-center">{{ $bankAccount->status }}</td>

                    <td class="text-center">
                        <!-- Edit and Delete buttons (if needed) -->
                        <a href="{{ route('user.bank-account.edit', [$userData->id, $bankAccount->id]) }}"
                            class="btn btn-sm btn-warning">Ubah</a>
                        <form action="{{ route('user.bank-account.destroy', [$userData->id, $bankAccount->id]) }}"
                            method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus Rekening ini? Tindakan ini tidak dapat dibatalkan.')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Rekening Tidak Ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>
@endsection

@push('javascript')
@endpush