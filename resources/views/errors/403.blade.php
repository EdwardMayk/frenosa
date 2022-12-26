@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message')
    <p>ESTA PÁGINA NO EXISTO O NO TIENE ACCESO</p>
    <a href="{{route('dashboard')}}">Volver</a>
@endsection
