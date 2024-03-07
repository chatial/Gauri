@extends('layouts.main')

@section('container')
<div class="container-section" style="margin-top: 50px">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 text-center">
            <img src="{{ asset('storage/' . $products->gambar) }}" alt="" class="img-fluid mx-auto">
                <h1 style="margin-top: 10px;">{{ $products->nama }}</h1>
                <p style="color:red;">{{ $products->harga }}</p>
                <p style="margin-top:10px;">{{ $products->detail }}</p>
                <div class="button-container">
                    <button type="button" class="custom-button"><a href="https://api.whatsapp.com/send?phone=6285709310078&text=Hallo%20min%20berikut%20pesanan%20saya%20:%20%0ANama%20Produk%20:%20{{ $products->nama }}%20%0AHarga%20:%20{{ $products->harga }}%20%0AGambar%20:%20{{ asset('storage/' . $products->gambar) }}"><i data-feather="shopping-cart"></a></i></button>
                </div>
        </div>
    </div>
</div>
@endsection