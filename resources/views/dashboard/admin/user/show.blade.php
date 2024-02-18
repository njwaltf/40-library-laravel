@extends('layouts.app')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1><a href="javascript:history.go(-1);"><i class="fas fa-arrow-left"></i></a> &nbsp;Detail Pengguna</h1>
        </div>
        @foreach ($user as $item)
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title m-3">Foto Profil <strong>{{ $item->name }}</strong></h5>
                        </div>
                        <div class="card-body">
                            <img src="@if ($item->prof_pic > 0) {{ asset('storage/' . $item->prof_pic) }}
                        @else {{ asset('assets/img/user-1.jpg') }} @endif"
                                width="250" height="250" class="rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4>Data Pengguna</h4>
                        </div>
                        <div class="card-body p-3">
                            <div class="row my-3">
                                <div class="col-lg-4 col-sm-12">
                                    <strong class="m-1">Nama Lengkap Pengguna</strong>
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                    <p class="m-1">{{ $item->name }}</p>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-4">
                                    <strong class="m-1">Tanggal Bergabung</strong>
                                </div>
                                <div class="col-lg-3">
                                    <p class="m-1">
                                        {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM YYYY') }}
                                    </p>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-4 col-sm-12">
                                    <strong class="m-1">Username Pengguna</strong>
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                    <p class="m-1">{{ $item->username }}</p>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-4 col-sm-12">
                                    <strong class="m-1">Alamat Email</strong>
                                </div>
                                <div class="col-lg-3 col-sm-12">
                                    <p class="m-1">{{ $item->email }}</p>
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="col-lg-4 col-sm-12">
                                    <strong class="m-1">Role</strong>
                                </div>
                                <div class="col-lg-4 col-sm-12">
                                    @switch($item->role)
                                        @case('admin')
                                            <div class="badge badge-dark">Admin</div>
                                        @break

                                        @case('member')
                                            <div class="badge badge-warning">Member</div>
                                        @break

                                        @default
                                            <div class="badge badge-primary">Pustakawan</div>
                                    @endswitch
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
@endsection
