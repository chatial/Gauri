@extends('layouts.main')

@section('container')
<div class="container-section" style="margin-top: 60px">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 text-center">
            @if ($weddings->galleryPhotos->count() > 0)
                <div class="gallery-container">
                    <div class="gallery-wrapper">
                        @foreach ($weddings->galleryPhotos as $photo)
                            <div class="gallery-item">
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="" class="img-fluid mx-auto" onclick="openLightbox('{{ asset('storage/' . $photo->photo_path) }}')">
                            </div>
                        @endforeach
                    </div>
                    <div class="gallery-nav">
                        <button id="prevButton" onclick="prevGallery()"><i data-feather="chevrons-left"></i></button>
                        <button id="nextButton" onclick="nextGallery()"><i data-feather="chevrons-right"></i></button>
                    </div>
                </div>
                <div class="lightbox" onclick="closeLightbox()">
                    <img id="lightbox-img" src="" alt="">
                </div>
            @else
                <p>No gallery photos available.</p>
            @endif
            <h1 style="margin-top: 10px;">{{ $weddings->nama }}</h1>
            <p>{{ $weddings->tempat }}</p>
            <p>{{ $weddings->tanggal }}</p>
            <p style="margin-top:10px;">{{ $weddings->detail }}</p>
            <div class="button-container">
                <button type="button" class="custom-button"><a href="https://api.whatsapp.com/send?phone=6285709310078"><i data-feather="phone"></a></i></button>
                <button type="button" class="custom-button"><a href="https://www.instagram.com/your_instagram/"><i data-feather="instagram"></a></i></button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentIndex = 0;
    const galleryWrapper = document.querySelector('.gallery-wrapper');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const nextButton = document.getElementById('nextButton');
    const prevButton = document.getElementById('prevButton');

    function openLightbox(imageSrc) {
        document.getElementById('lightbox-img').src = imageSrc;
        document.querySelector('.lightbox').classList.add('show');
    }

    function closeLightbox() {
        document.querySelector('.lightbox').classList.remove('show');
    }

    function nextGallery() {
        const numItems = galleryItems.length;
        const maxVisibleItems = 4;
        currentIndex += 1;

        if (currentIndex >= numItems) {
            currentIndex = 0;
        }

        updateGallery();
    }

    function prevGallery() {
        const numItems = galleryItems.length;
        const maxVisibleItems = 4;
        currentIndex -= 1;

        if (currentIndex < 0) {
            currentIndex = numItems - 1;
        }

        updateGallery();
    }

    function updateGallery() {
        const numItems = galleryItems.length;
        const maxVisibleItems = 4;

        // Show/hide the next and previous buttons based on the number of items
        nextButton.style.display = numItems > maxVisibleItems ? 'block' : 'none';
        prevButton.style.display = numItems > maxVisibleItems ? 'block' : 'none';

        const newTranslateValue = -currentIndex * (100 / maxVisibleItems) + '%';
        galleryWrapper.style.transform = 'translateX(' + newTranslateValue + ')';
    }

    // Initial check to hide the buttons if there are four or fewer items
    updateGallery();
</script>

@endsection
