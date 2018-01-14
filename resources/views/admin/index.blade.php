@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <span>Вы вошли в систему как:</span><span>{{' ' . $admin->name}}</span>
@endsection