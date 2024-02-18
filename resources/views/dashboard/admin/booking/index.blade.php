@extends('layouts.app')

@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Kelola Peminjaman</h1>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Success and error messages -->
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if (session()->has('successEdit'))
                    <div class="alert alert-warning alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('successEdit') }}
                        </div>
                    </div>
                @endif
                @if (session()->has('successDelete'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('successDelete') }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Peminjaman</h4>
                    </div>
                    <div class="card-body">
                        <div class="float-right">
                            <a href="/bookings-management/create" class="btn btn-primary">Tambah Peminjaman <i
                                    class="fas fa-plus"></i></a>
                        </div>
                        <!-- Search and filter form -->
                        <div class="float-left mb-3">
                            <form method="GET">
                                <div class="input-group">
                                    <select class="form-control selectric mx-2" name="status">
                                        <option value="">Semua Status</option>
                                        @foreach (['Diajukan', 'Dipinjam', 'Dikembalikan', 'Dikembalikan Terlambat'] as $status)
                                            <option value="{{ $status }}"
                                                {{ request()->get('status') == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" placeholder="Kode peminjaman ..."
                                        name="search_keyword" value="{{ request()->get('search_keyword') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Kode Peminjaman</th>
                                        <th scope="col">Judul Buku</th>
                                        <th scope="col">Peminjam</th>
                                        <th scope="col">Tanggal Peminjaman</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookings as $booking)
                                        <tr>
                                            <th scope="row">{{ $booking->booking_code }}</th>
                                            <td>{{ $booking->book->title }}</td>
                                            <td>{{ $booking->user->name }}</td>
                                            <td>{{ date('d-m-Y', strtotime($booking->book_at)) }}</td>
                                            <td>
                                                {{-- <div class="badge badge-warning">Member</div> --}}
                                                <span
                                                    @if ($booking->status === 'Diajukan') class="badge badge-warning rounded-3 fw-semibold"
                                            @elseif ($booking->status === 'Dipinjam') class="badge badge-success rounded-3 fw-semibold" @elseif ($booking->status === 'Dikembalikan') class="badge badge-dark rounded-3 fw-semibold" @elseif ($booking->status === 'Ditolak') class="badge badge-danger rounded-3 fw-semibold" @elseif ($booking->status === 'Dikembalikan Terlambat') class="badge badge-danger rounded-3 fw-semibold" @endif>{{ $booking->status }}</span>
                                            </td>
                                            <td>
                                                <a href="/bookings-management/{{ $booking->id }}/"
                                                    class="btn btn-info m-1">Detail <i class="fas fa-arrow-right"></i></a>
                                                <a href="/bookings-management/{{ $booking->id }}/edit"
                                                    class="btn btn-warning m-1">Ubah <i class="fas fa-edit"></i></a>
                                                <form action="/bookings-management/{{ $booking->id }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger m-1" type="submit"
                                                        onclick="return confirm('Apakah kamu yakin ingin menghapus peminjaman ini?')">Batalkan
                                                        <i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">No data found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        {{ $bookings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
