@extends('layouts.master-layouts')
@section('content')

<transition name="slide-fade">
  <router-view :role="'{{ auth()->user()->role }}'"></router-view>
</transition>

@endsection