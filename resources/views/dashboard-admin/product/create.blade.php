@extends('dashboard-admin.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Product</h1>
</div>

<div class="col-lg-8">
    <form method="post" action="{{ route('admin-product.store') }}" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" required autofocus value="{{ old('nama') }}">
            @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <div class="input-group">
                <input type="text" class="form-control" id="harga" name="harga" required value="{{ old('harga') }}">
                <div class="invalid-feedback" id="hargaError"></div>
            </div>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Upload Gambar</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" required accept="image/*" onchange="previewImage()">
            @error('gambar')
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

        <button type="submit" class="btn btn-primary">Create</button>
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

    document.addEventListener('DOMContentLoaded', function () {
        const hargaInput = document.getElementById('harga');
        const hargaError = document.getElementById('hargaError');

        hargaInput.addEventListener('input', function (e) {
            // Menghapus karakter non-digit
            let harga = e.target.value.replace(/\D/g, '');

            // Menerapkan format rupiah
            harga = formatRupiah(harga);

            // Mengisi nilai kembali ke input
            e.target.value = harga;

            // Validasi input (opsional)
            if (harga.length === 0) {
                hargaError.textContent = 'Harga tidak boleh kosong';
            } else {
                hargaError.textContent = '';
            }
        });

        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + ribuan;
        }
    });

    function previewImage(){
        const image = document.querySelector('#gambar');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

@endsection