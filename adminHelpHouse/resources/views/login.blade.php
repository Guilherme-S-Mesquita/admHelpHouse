@extends('layouts.main')

@section('title', 'Login')

@section('contentAdmin')
<h1>login</h1>

<a href="{{ route('dashboard') }}">home</a>

<form action="{{ route('login.store') }}" method="POST">
    @csrf
    error('err')
        <span>{{ $message }}</span>
    enderror
    @error('email')
     <span>{{ $message }}</span>
    @enderror
    <input type="text" name="email" value="admin@gmail.com">
    @error('senha')
     <span>{{ $message }}</span>
    @enderror
    <input type="password" name="senha" value="123">
    <button type="submit">enviar</button>
</form>

@endsection