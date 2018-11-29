@extends('layouts.master-layouts')
@section('content')
<div class="page-header">
    <h1 class="page-title"><i class="icon wb-user"></i> Data Santri</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Master Santri</a></li>
        <li class="breadcrumb-item active">Data Santri</li>
    </ol>
</div>

<transition name="slide-fade">
	<router-view>
	</router-view>
</transition>
@endsection