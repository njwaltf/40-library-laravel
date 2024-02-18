@extends('layouts.app')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1><a href="javascript:history.go(-1);"><i class="fas fa-arrow-left"></i></a> &nbsp;Detail Kategori Buku</h1>
        </div>
        <style>
            .invalid {
                color: red;
            }
        </style>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card w-100">
                    <div class="card-header">
                        <h5 class="card-title fw-semibold m-3">{{ $category->name }}</h5>
                    </div>
                    <div class="card-body p-3">
                        {!! $category->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
