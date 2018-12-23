@extends('layouts.master-layouts')
@section('content')

<transition name="fade-out">
  <router-view></router-view>
</transition>

@endsection