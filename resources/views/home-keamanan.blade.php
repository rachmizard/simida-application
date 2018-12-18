@extends('layouts.master-layouts')
@section('content')

<router-view>
	<transition name="slide-fade"></transition>
</router-view>

@endsection