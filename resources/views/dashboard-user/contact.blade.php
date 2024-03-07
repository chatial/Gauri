@extends('layouts.main')

@section('container')
    <div id="contact" class="contact" style="margin-top: 100px">
        <h2><span>Contact</span> Kami</h2>
        <p>Jl. Cibogo No.49, Sukawarna, Kec. Sukajadi, Kota Bandung, Jawa Barat 40164</p>
        <div class="row" style="display: flex; justify-content: center; margin-top: 10px; gap: 10px;">
            <div class="col-lg-4 text-center">
                <a href="https://wa.me/1234567890" style="text-decoration: none; color: inherit;">
                    <i data-feather="phone"></i>
                </a>
            </div>
            <div class="col-lg-4 text-center">
                <a href="https://www.instagram.com/your_instagram/" style="text-decoration: none; color: inherit;">
                    <i data-feather="instagram"></i>
                </a>
            </div>
            <div class="col-lg-4 text-center">
                <a href="mailto:info@example.com" style="text-decoration: none; color: inherit;">
                    <i data-feather="twitter"></i>
                </a>
            </div>
        </div>
    </div>
@endsection