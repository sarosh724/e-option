@extends('site.templates.index')

@section('content')
    @include('site.sections.breadcrumb', ['title' => 'about us'])
    @include('site.sections.about')
@stop
