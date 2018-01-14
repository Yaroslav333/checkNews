@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <div class="row" style="margin-top: 20px;">
        <form class="col s6" id="store-user-form" action="/admin/users" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12">
                    <input value="" name="user_name" id="user_name" type="text" class="validate" required>
                    <label class="active" for="user_name">Имя</label>
                </div>
                <div class="input-field col s12">
                    <input id="user_email" type="email" name="user_email" class="validate" required>
                    <label for="user_email">Email</label>
                </div>
                <div class="input-field col s12">
                    <input id="user_password" type="password" name="user_password" class="validate" required>
                    <label for="user_password">Пароль</label>
                </div>
                <div class="input-field col s12">
                    <input id="user_confirm_password" type="password" name="user_confirm_password" class="validate" required>
                    <label for="user_confirm_password">Повторите пароль</label>
                </div>
            </div>
            <div style="margin-top: 30px; margin-left: 15px;">
                <button type="submit" class="waves-effect waves-light btn" style="background-color: #ff8905" id="store-user">Сохранить</button>
            </div>
        </form>
    </div>
@endsection