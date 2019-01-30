@extends('layouts.master-layouts')
@section('content')
    <div class="page-header">
        <h1 class="page-title"><i class="icon wb-user"></i> Tambah User</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Admin Panel</li>
            <li class="breadcrumb-item">Hak Akses User</li>
            <li class="breadcrumb-item active">Tambah User</li>
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
          <h3 class="panel-title">Tambah User</h3>
        </header>
	        <div class="panel-body">
	        	<form action="{{ route('admin.user-level.store') }}" method="POST">
	        		{{ csrf_field() }}
			          <div class="form-group col-md-12">
			            <label for="">Nama</label>
			            <input type="text" class="form-control" name="name" autocomplete="off" required="">
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">Username</label>
			            <input type="text" class="form-control" name="username" autocomplete="off" required="">
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">Email</label>
			            <input type="email" class="form-control" name="email" autocomplete="off" required="">
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">New Password</label>
			            <input type="password" class="form-control" name="password" autocomplete="off" required="">
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">Hak Akses</label>
			            <select name="role" class="form-control" required="">
			            	<option selected disabled>--Hak Akses--</option>
							<option value="admin">Admin/Murobbi</option>
							<option value="sekretariat">Sekretariat</option>
							<option value="pendidikan">Pendidikan</option>
							<option value="keuangan">Keuangan</option>
							<option value="keamanan">Keamanan</option>
			            </select>
			          </div>
			          <div class="form-group col-md-12">
			            <label for="">Status</label>
			            <select name="status" class="form-control" required="">
			            	<option selected disabled>--Status Akun--</option>
							<option value="aktif">Aktif</option>
							<option value="non_aktif">Block/Matikan</option>
			            </select>
			          </div>
			          <div class="form-group col-md-12">
			            <button class="btn btn-sm btn-primary"><i class="icon wb-check"></i> Simpan</button>
			            <a href="{{ route('admin.user-level.index') }}" class="btn btn-sm btn-warning"> Kembali</a>
			          </div>
	        	</form>
	        </div>
      </div>
      <!-- End Panel Table Tools -->
@endsection