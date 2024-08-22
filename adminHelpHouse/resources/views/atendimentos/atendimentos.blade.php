@extends('layouts.main')

@section('title', 'Dashboard')

@section('contentAdmin')

<div class="main p-3">
<div class="backdrop">

{{-- Aqui ele busca o usuario logado -> name para apenas pegar o nome --}}
<div class="inicio">
<div class="header mb-4 ">
    <h1>Olá, <span style="color: #ff6347;">{{$user->name}}</span></h1>
</div>
</div>