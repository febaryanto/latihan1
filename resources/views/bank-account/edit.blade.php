@extends('base')

@section('header')
<title>Ubah Rekening {{ $bankAccount['user']->name }}</title>
@endsection

@section('content')
<div class="container content  mt-3">
    <h2>Ubah Rekening {{ $bankAccount['user']->name }}</h2>
    @include('notification')
    <form action="{{ route('user.bank-account.update',[$bankAccount['user']->id,$bankAccount->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-5 mt-3">
            <!-- Bootstrap Card -->
            <div class="card">
                <!-- Card Header (Title) -->
                {{-- <div class="card-header">
                        <h5 class="card-title">Create New User</h5>
                    </div> --}}
                <!-- Card Body (Form Fields) -->
                <div class="card-body">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="bank_name" class="form-label">Nama Bank</label>
                        <select class="form-select" id="bank_name" name="bank_name" required>
                            <option value="" disabled selected>Pilih Nama Bank</option>
                            <option value="BCA" {{ $bankAccount->bank_name == 'BCA' ? 'selected' : '' }}>BCA (Bank Central Asia)</option>
                            <option value="Mandiri" {{$bankAccount->bank_name  == 'Mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                            <option value="BNI" {{$bankAccount->bank_name  == 'BNI' ? 'selected' : '' }}>BNI (Bank Negara Indonesia)</option>
                            <option value="BRI" {{$bankAccount->bank_name  == 'BRI' ? 'selected' : '' }}>BRI (Bank Rakyat Indonesia)</option>
                            <option value="BTN" {{$bankAccount->bank_name  == 'BTN' ? 'selected' : '' }}>BTN (Bank Tabungan Negara)</option>
                        </select>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Rekening</label>
                        <input type="account_number" class="form-control" id="account_number" name="account_number"
                            value="{{ $bankAccount->account_number  }}" required>
                    </div>

                    <!-- Rekening (Radio Buttons) -->
                    <div class="mb-3">
                        <label class="form-label">Status</label> <!-- Added mb-3 for spacing below label -->
                        <div class="mt-2"> <!-- Add margin-top here to create space -->
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="active"
                                    value="active" {{  $bankAccount->status == 'active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="active">Active</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inactive"
                                    value="inactive" {{ $bankAccount->status == 'inactive' ? 'checked' : '' }}>
                                <label class="form-check-label" for="inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer (Submit Button) -->
                <div class="card-footer text-end">
                    <a href="{{ route('user.bank-account.index',$bankAccount['user']->id) }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Ubah Rekening</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('javascript')
@endpush