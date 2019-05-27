@extends('layouts.master-layouts')
@section('content')
    <div class="page-header">
        <h1 class="page-title"><i class="icon wb-user"></i> Edit User {{ $user->name }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Admin Panel</li>
            <li class="breadcrumb-item">Hak Akses User</li>
            <li class="breadcrumb-item active">Edit User {{ $user->name }}</li>
        </ol>
    </div>

	@if(session('messageSuccess'))
	<div class="alert dark alert-icon alert-success alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	      {{ session('messageSuccess') }}
	</div>
	@endif

	 <!-- Panel Table Tools -->
      <div class="panel" id="app">
        <header class="panel-heading">
          <h3 class="panel-title">Edit User</h3>
        </header>
	        <div class="panel-body">
	        	<form action="{{ route('admin.user-level.update', $user->id) }}" method="POST">
	        		  <input type="hidden" name="_method" name="PUT">
	        		  {{ method_field('PATCH') }}
	        		{{ csrf_field() }}
			          <div class="form-group col-md-12">
			            <label for="">Nama</label>
			            <input type="text" class="form-control" name="name" autocomplete="off" value="{!! $user->name !!}" required="">
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">Username</label>
			            <input type="text" class="form-control" name="username" autocomplete value="{!! $user->username !!}" required="">
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">Email</label>
			            <input type="email" class="form-control" name="email" autocomplete value="{!! $user->email !!}" required="">
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">Update Password</label>
			            <input type="password" class="form-control" name="password" autocomplete>
			            <span class="badge badge-sm badge-info">Lewati bila tidak di perlukan.</span>
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">Hak Akses</label>
			            <select name="role" class="form-control" required="">
			            	<option selected disabled>--Hak Akses--</option>
							<option value="murobbi" {!! $user->role == 'murobbi' ? 'selected' : '' !!}>Admin/Murobbi</option>
							<option value="sekretariat" {!! $user->role == 'sekretariat' ? 'selected' : '' !!}>Sekretariat</option>
							<option value="pendidikan" {!! $user->role == 'pendidikan' ? 'selected' : '' !!}>Pendidikan</option>
							<option value="keuangan" {!! $user->role == 'keuangan' ? 'selected' : '' !!}>Keuangan</option>
							<option value="keamanan" {!! $user->role == 'keamanan' ? 'selected' : '' !!}>Keamanan</option>
			            </select>
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">Status</label>
			            <select name="status" class="form-control" required="">
			            	<option selected disabled>--Status Akun--</option>
							<option value="aktif" {!! $user->status == 'aktif' ? 'selected' : '' !!}>Aktif</option>
							<option value="non_aktif" {!! $user->status == 'non_aktif' ? 'selected' : '' !!}>Block/Matikan</option>
			            </select>
			          </div>
			          <div class="form-group col-md-12">
			            <button class="btn btn-sm btn-primary"><i class="icon wb-check"></i> Edit</button>
			            <a href="{{ route('admin.user-level.index') }}" class="btn btn-sm btn-warning"> Kembali</a>
			          </div>
	        	</form>
	        </div>
      </div>
      <!-- End Panel Table Tools -->
@endsection