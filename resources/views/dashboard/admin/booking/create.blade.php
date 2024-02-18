@extends('layouts.app')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Peminjaman</h1>
        </div>
        <form action="/bookings-management" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Informasi Utama</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="book_id" class="form-label">Judul Buku</label>
                                        <p>Isikan judul buku yang akan dipinjam.</p>
                                        <div class="form-group">
                                            <select
                                                class="form-control select2 @error('book_id')
                                                is-invalid
                                            @enderror"
                                                name="book_id">
                                                <option value="" selected>Pilih Judul Buku</option>
                                                @forelse ($books as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if (old('book_id') === $item->id) selected @endif>
                                                        {{ $item->title }} |
                                                        ID:{{ $item->id }}</option>
                                                @empty
                                                    <option value="">Belum ada buku</option>
                                                @endforelse
                                            </select>
                                            @error('book_id')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="user_id" class="form-label">Nama Peminjam</label>
                                        <p>Isikan nama peminjam.</p>
                                        <div class="form-group">
                                            <select
                                                class="form-control select2 @error('user_id')
                                            is-invalid
                                            @enderror"
                                                name="user_id">
                                                <option value="" selected>Pilih nama peminjam</option>
                                                @forelse ($users as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if (old('user_id') === $item->id) selected @endif>
                                                        {{ $item->name }} |
                                                        EMAIL:{{ $item->email }}</option>
                                                @empty
                                                    <option value="">Belum ada pengguna</option>
                                                @endforelse
                                            </select>
                                            @error('user_id')
                                                <p class="invalid" style="color: red">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Informasi Lanjutan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-4">
                                        <label for="book_at" class="form-label">Tanggal Peminjaman</label>
                                        <p>Pilih tanggal mulai meminjam</p>
                                        <input type="text"
                                            class="form-control datepicker @error('book_at') is-invalid @enderror"
                                            id="book_at" name="book_at" value="{{ old('book_at') }}">
                                        @error('book_at')
                                            <p class="invalid" style="color: red">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="status" class="form-label">Set status peminjaman</label>
                                        <p>Atur status peminjaman.</p>
                                        <div class="form-group">
                                            <div class="selectgroup w-100">
                                                {{-- <label class="selectgroup-item">
                                                    <input type="radio" name="status" value="Diajukan"
                                                        class="selectgroup-input" checked="">
                                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                                            class="fas fa-paper-plane"></i> Diajukan</span>
                                                </label> --}}
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status" value="Dipinjam"
                                                        class="selectgroup-input"
                                                        {{ old('status') === 'Dipinjam' ? 'checked' : '' }}>
                                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                                            class="fas fa-bookmark"></i> Dipinjam</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status" value="Dikembalikan"
                                                        class="selectgroup-input"
                                                        {{ old('status') === 'Dikembalikan' ? 'checked' : '' }} disabled>
                                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                                            class="fas fa-undo-alt"></i> Dikembalikan</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status" value="Dikembalikan Terlambat"
                                                        class="selectgroup-input"
                                                        {{ old('status') === 'Dikembalikan Terlambat' ? 'checked' : '' }}
                                                        disabled>
                                                    <span class="selectgroup-button selectgroup-button-icon"><i
                                                            class="fas fa-exclamation-triangle"></i> Dikembalikan
                                                        Terlambat</span>
                                                </label>
                                            </div>
                                        </div>
                                        @error('status')
                                            <p class="invalid" style="color: red">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <button type="submit" class="btn btn-primary" style="margin-right: 15px">Buat Peminjaman <i
                            class="ti ti-plus"></i></button>
                    <a href="javascript:history.go(-1);" class="btn btn-outline-warning">Batal</a>
                </div>
            </div>
        </form>
    </section>
@endsection
