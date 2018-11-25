@extends('layouts.master-layouts')
@section('content')
<div class="page-header">
    <h1 class="page-title">Data Guru</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Master Guru</a></li>
        <li class="breadcrumb-item active">Data Guru</li>
    </ol>
</div>

<transition name="slide-fade">
    <router-view>
    </router-view>
</transition>

<list-guru-component></list-guru-component>

@endsection