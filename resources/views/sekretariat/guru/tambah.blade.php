@extends('layouts.master-layouts')
@section('content')

<div class="page-header">
    <h1 class="page-title">Tambah Guru</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Master Guru</a></li>
        <li class="breadcrumb-item active">Tambah Guru</li>
    </ol>
</div>

<form-guru-component></form-guru-component>

@endsection