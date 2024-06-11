@extends('errors::illustrated-layout')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found'))
@section('image')
    <img style=" max-width: 100%;
  height: auto;" src="/assets/template/img/undraw_by_the_road_re_vvs7.svg" alt="">
@endsection
