@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <div style="margin-top: 30px; margin-left: 20px;">
        <a href="/admin/users/create" class="waves-effect waves-light btn" style="background-color: #ff8905">Добавить Администратора</a>
    </div>

    <div class="row">
        <div class="col m12" style="margin-top: 30px;">

        </div>
    </div>


@endsection