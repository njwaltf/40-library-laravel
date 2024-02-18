@extends('layouts.app')
@section('main')
    <section class="section">
        <div class="section-header">
            <h1>Tambah Kategori Buku</h1>
        </div>
        <form action="/categories-management" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Informasi Utama</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <label for="name" class="form-label">Nama Kategori</label>
                                        <p>Isikan nama kategori</p>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}">
                                        @error('name')
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
                                        <label for="description" class="form-label">Deskripsi Kategori</label>
                                        <p>Isikan deskripsi kategori secara singkat.</p>
                                        <textarea class="summernote-simple" name="description">{{ old('description') }}</textarea>
                                        @error('description')
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
                    <button type="submit" class="btn btn-primary" style="margin-right: 15px">Tambah Kategori <i
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
