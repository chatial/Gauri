@extends('layouts.main')

@section('container')
<div class="login-container">
    <h2>Login</h2>
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Masukan Alamat Email...">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="Masukan Password...">
        </div>

        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
</div>

@endsection