@extends('layouts.master-layouts')
@section('content')

<div class="page-header">
    <h1 class="page-title">Form Kelas</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="../index-2.html">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:void(0)">Forms</a></li>
        <li class="breadcrumb-item active">Kelas</li>
    </ol>
    <!-- <div class="page-header-actions">
        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Edit">
            <i class="icon wb-pencil" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Refresh">
            <i class="icon wb-refresh" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-sm btn-icon btn-default btn-outline btn-round" data-toggle="tooltip" data-original-title="Setting">
            <i class="icon wb-settings" aria-hidden="true"></i>
        </button>
    </div> -->
</div>

<form-kelas-component></form-kelas-component>
@endsection