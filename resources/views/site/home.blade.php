@extends('layouts.minhlong')

@section('content')
@include('site.partials.home-hero')

@include('site.partials.home-sections')

@include('site.partials.home-blog', ['posts' => $posts ?? collect()])
@endsection
