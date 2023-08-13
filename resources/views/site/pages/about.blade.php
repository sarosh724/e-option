@extends('site.templates.index')

@section('page-title')
    About Us
@stop

@section('content')
    @include('site.sections.breadcrumb', ['title' => 'about us'])
    @include('site.sections.about')
@stop
