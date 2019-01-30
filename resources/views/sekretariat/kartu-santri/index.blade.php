@extends('layouts.master-layouts')
@section('content')
<div class="page-header">
    <h1 class="page-title">Kartu Santri</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Sekretariat</a></li>
        <li class="breadcrumb-item active">Kartu Santri</li>
    </ol>
</div>

<transition>
    <router-view>
    </router-view>
</transition>

@endsection