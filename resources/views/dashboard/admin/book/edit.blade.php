@extends('layouts.app')

@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Edit Buku</h1>
        </div>
        <form action="/books-management/{{ $book->id }}" method="post" enctype="multipart/form-data">
            @method('put')
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
                                        <label for="title" class="form-label">Judul Buku</label>
                                        <p>Isikan judul buku yang akan diupdate.</p>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title', $book->title) }}">
                                        @error('title')
                                            <p class="invalid" style="color: red">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-4">
                                        <label for="category_id" class="form-label">Kategori Buku</label>
                                        <p>Pilih kategori buku yang sesuai.</p>
                                        <div class="form-group">
                                            <select class="form-control select2" name="category_id">
                                                @forelse ($categories as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ old('category_id', $book->category_id) == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @empty
                                                    <option value="">Belum ada kategori</option>
                                                @endforelse
                                            </select>
                                        </div>
                                        @error('category_id')
                                            <p class="invalid" style="color: red">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="desc" class="form-label">Deskripsi Buku</label>
                                        <p>Isikan deskripsi buku secara singkat.</p>
                                        <textarea class="summernote-simple" name="desc">{{ old('desc', $book->desc) }}</textarea>
                                        @error('desc')
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
            {{-- tersangka dan korban --}}
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Informasi Buku & Penulis</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-4">
                                        <label for="stock" class="form-label">Jumlah Stok</label>
                                        <p>Jumlah stok buku yang tersedia saat ini</p>
                                        <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                            id="stock" name="stock" value="{{ old('stock', $book->stock) }}">
                                        @error('stock')
                                            <p class="invalid" style="color: red">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-4">
                                        <label for="publisher" class="form-label">Nama Penerbit</label>
                                        <p>Isikan nama perusahaan penerbit dari buku ini</p>
                                        <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                                            id="publisher" name="publisher"
                                            value="{{ old('publisher', $book->publisher) }}">
                                        @error('publisher')
                                            <p class="invalid" style="color: red">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-4">
                                        <label for="writer" class="form-label">Nama Penulis</label>
                                        <p>Isikan nama penulis dari buku ini.</p>
                                        <input type="text" class="form-control @error('writer') is-invalid @enderror"
                                            id="writer" name="writer" value="{{ old('writer', $book->writer) }}">
                                        @error('writer')
                                            <p class="invalid" style="color: red">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-4">
                                        <label for="publish_date" class="form-label">Tanggal Terbit</label>
                                        <p>Tanggal terbit dari buku.</p>
                                        {{-- <input type="text" class="form-control datepicker"> --}}
                                        <input type="text"
                                            class="form-control datepicker @error('publish_date') is-invalid @enderror"
                                            id="publish_date" name="publish_date"
                                            value="{{ old('publish_date', $book->publish_date) }}">
                                        @error('publish_date')
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
            {{-- latar tempat dan waktu --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Upload Cover</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-4">
                                        <label for="image" class="form-label">Upload Cover Buku</label>
                                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                                            id="image" name="image" value=""
                                            onchange="previewImage(event);">
                                        @if ($book->image > 0)
                                            <img id="preview-selected-image" class="img-fluid m-2" height="200"
                                                width="150" src="{{ asset('storage/' . $book->image) }}">
                                        @else
                                            <img id="preview-selected-image" class="img-fluid m-2" height="200"
                                                width="150">
                                        @endif
                                        @error('image')
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
                    <button type="submit" class="btn btn-primary" style="margin-right: 15px">Tambah Buku <i
                            class="ti ti-plus"></i></button>
                    <a href="javascript:history.go(-1);" class="btn btn-outline-warning">Batal</a>
                </div>
            </div>
        </form>
        <script>
            const previewImage = (event) => {
                /**
                 * Get the selected files.
                 */
                const imageFiles = event.target.files;
                /**
                 * Count the number of files selected.
                 */
                const imageFilesLength = imageFiles.length;
                /**
                 * If at least one image is selected, then proceed to display the preview.
                 */
                if (imageFilesLength > 0) {
                    /**
                     * Get the image path.
                     */
                    const imageSrc = URL.createObjectURL(imageFiles[0]);
                    /**
                     * Select the image preview element.
                     */
                    const imagePreviewElement = document.querySelector("#preview-selected-image");
                    /**
                     * Assign the path to the image preview element.
                     */
                    imagePreviewElement.src = imageSrc;
                    /**
                     * Show the element by changing the display value to "block".
                     */
                    imagePreviewElement.style.display = "block";
                }
            };
        </script>
    </section>
@endsection
