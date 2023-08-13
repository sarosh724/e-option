@extends('site.templates.index')

@section('page-title')
    Home
@stop

@section('content')
    @include('site.sections.banners')
    @include('site.sections.about')
    @include('site.sections.choose')
@stop
