@extends('layouts.main')

@section('container')
    <div id="product" class="product" style="margin-top: 60px">
        <h2><span>Our</span> Wedding</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia nam modi, qui commodi eaque esse?</p>
        <div class="row">
            @foreach($weddings as $wedding)
                <div class="product-card" style="position: relative; flex: 0 0 23%; max-width: 23%; margin-right: 5px;">
                    <a href="{{ route('dashboard-admin.wedding.show', $wedding->id) }}">
                        <img src="{{ asset('storage/' . $wedding->thumbnail) }}" alt="table" class="product-card-img" style="position: relative; filter: brightness(70%); width: 100%; height: 200px; object-fit: cover;">
                        <h3 class="product-card-title" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); font-size: 16px; font-weight: bold; background-color: rgba(0, 0, 0, 0.7); padding: 10px; border-radius: 5px;">{{$wedding->tanggal}}</h3>
                    </a>
                </div>
            @endforeach
        </div>
                
    </div>
@endsection