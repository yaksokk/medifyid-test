@extends('layout.app')

@section('content')
<div class="container">
    <div>
        @include('kategori.index.filter')
    </div>
    <div>
        <span>Daftar Kategori</span>
        @include('kategori.index.table')
    </div>
</div>
