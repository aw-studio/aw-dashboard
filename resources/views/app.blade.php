@extends('aw-dashboard::app')

@section('head')
<link rel="stylesheet" href="{{asset('css/app.css')}}?v={{filemtime('css/app.css')}}">
@endsection

@section('app')
<div id="app" class="p-8">
    @yield('content')
</div>
@endsection