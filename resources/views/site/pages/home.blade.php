@extends('site.templates.index')

@section('page-title')
    Home
@stop

@section('content')
    @include('site.sections.banners')
{{--    @include('site.sections.services')--}}
    @include('site.sections.about')
{{--    @include('site.sections.stats')--}}
{{--    @include('site.sections.testimonials')--}}
    @include('site.sections.choose')
@stop
