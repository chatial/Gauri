@extends('dashboard-admin.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Wedding</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="{{ route('admin-wedding.update', $wedding->id) }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="thumbnail" class="form-label">Upload thumbnail</label>
            <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" onchange="previewImage()">
            @if ($wedding->thumbnail)
                <div class="mt-2">
                    <p>Thumbnail Sebelumnya:</p>
                    <img src="{{ asset('storage/' . $wedding->thumbnail) }}" class="img-preview img-fluid d-block">
                </div>
            @endif
            @error('thumbnail')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        
        <!-- Gallery Photos -->
        <div class="mb-3">
            <label for="gallery_photos" class="form-label">Gallery Photos</label>
            <input type="file" class="form-control @error('gallery_photos.*') is-invalid @enderror" id="gallery_photos" name="gallery_photos[]" multiple accept="image/*" onchange="previewGalleryImages()">
            @error('gallery_photos.*')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <p style="color: red;">*Masukan Banyak Foto Secara Langsung / tidak satu-satu</p>
            <small class="text-muted" id="photo-count"></small> <!-- Display photo count -->
        
            <!-- Image preview for gallery photos -->
            <div class="mb-3">
                <label class="form-label">Gallery Photo Preview</label>
                <div class="row" id="gallery-preview">
                    @foreach ($wedding->galleryPhotos as $galleryPhoto)
                        <div class="col-sm-3 mt-2">
                            <img src="{{ asset('storage/' . $galleryPhoto->photo_path) }}" class="img-thumbnail">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama', $wedding->nama) }}">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" required autofocus value="{{ old('tanggal', $wedding->tanggal) }}">
            @error('tanggal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="tempat" class="form-label">Tempat</label>
            <input type="text" class="form-control @error('tempat') is-invalid @enderror" id="tempat" name="tempat" required autofocus value="{{ old('tempat', $wedding->tempat) }}">
            @error('tempat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="detail" class="form-label">Detail</label>
            @error('detail')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input id="detail" type="hidden" name="detail" value="{{ old('detail') }}" required>
            <trix-editor input="detail"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault();
    })

    // Add an event listener for Trix Editor change event
    document.addEventListener('trix-change', function(event) {
            // Get the raw text content from Trix Editor
            var rawText = stripHtml(event.target.innerHTML);

            // Set the raw text value to the hidden input
            document.getElementById('detail').value = rawText;
        });

        // Function to strip HTML tags
        function stripHtml(html) {
            var doc = new DOMParser().parseFromString(html, 'text/html');
            return doc.body.textContent || "";
        }

    function previewImage(){
        const image = document.querySelector('#thumbnail');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }

    function previewGalleryImages() {
        const galleryPhotosInput = document.querySelector('#gallery_photos');
        const galleryPreviewContainer = document.querySelector('#gallery-preview');
        const photoCountText = document.querySelector('#photo-count');

        galleryPreviewContainer.innerHTML = ''; // Clear previous previews

        const selectedFiles = galleryPhotosInput.files;
        const photoCount = selectedFiles.length;

        // Display photo count
        photoCountText.textContent = photoCount + ' photo(s) selected';

        Array.from(selectedFiles).forEach(file => {
            const imgPreview = document.createElement('div');
            imgPreview.className = 'col-sm-3 mt-2';

            const imgElement = document.createElement('img');
            imgElement.className = 'img-thumbnail';

            imgElement.src = URL.createObjectURL(file);

            imgPreview.appendChild(imgElement);
            galleryPreviewContainer.appendChild(imgPreview);
        });
    }




</script>

@endsection