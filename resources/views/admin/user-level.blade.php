@extends('layouts.master-layouts')
@section('content')
    <div class="page-header">
        <h1 class="page-title"><i class="icon wb-user"></i> Hak Akses User</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Admin Panel</li>
            <li class="breadcrumb-item active">Hak Akses User</li>
        </ol>
    </div>

	 <!-- Panel Table Tools -->
      <div class="panel" id="app">
    
        <header class="panel-heading">
          <h3 class="panel-title"></h3>
          <div class="form-group col-md-6" style="margin-left: 15px;">
          	<a href="{{ route('admin.user-level.create') }}" class="btn btn-sm btn-success"><i class="icon wb-plus"></i> Tambah User</a>
          </div>
        </header>
        <div class="panel-body">
          <table class="table table-hover dataTable table-striped w-full" id="periodeTable">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="20%">Username </th>
                <th width="20%">Hak Akses</th>
                <th width="20%">Status</th>
                <th width="20%" class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
            	@foreach($users as $user)
            	<tr>
            		<td>{{ $loop->iteration }}</td>
            		<td>{{ $user->username }}</td>
            		<td><span class="badge badge-info">{{ $user->role }}</span></td>
            		<td><span class="badge {{ $user->status == 'aktif' ? 'badge-success' : 'badge-danger' }}">{{ $user->status == 'aktif' ? 'AKTIF' : 'NON-AKTIF/BLOCKED' }}</span></td>
            		<td>
            			<div class="form-group">
            				<a href="{{ route('admin.user-level.edit', $user->id) }}" class="btn btn-sm btn-icon btn-success btn-outline btn-round"
					          data-toggle="tooltip" data-original-title="Edit Akun User">
					          <i class="icon wb-pencil"></i>
					    	</a>
					    	<form action="{{ route('admin.user-level.destroy', $user->id) }}" method="POST">
					    		{{ method_field('DELETE') }}
					    		{{ csrf_field() }}
					    		<!-- <input type="hidden" value="DELETE" name="_method"> -->
						    	<button type="submit" class="btn btn-sm btn-icon btn-danger btn-outline btn-round"
						          data-toggle="tooltip" data-original-title="Hapus Akun User">
						          <i class="icon wb-trash"></i>
						    	</button>
					    	</form>
            			</div>
            		</td>
            	</tr>
            	@endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="5%">No</th>
                <th width="20%">Username </th>
                <th width="20%">Hak Akses</th>
                <th width="20%">Status</th>
                <th width="20%" class="text-center">Aksi</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <!-- End Panel Table Tools -->
@endsection