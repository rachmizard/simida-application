@extends('layouts.master-layouts')
@section('content')

<transition name="slide-fade">
  <router-view></router-view>
</transition>

@endsection