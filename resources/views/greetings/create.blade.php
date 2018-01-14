@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <div class="row" style="margin-top: 20px;">
        <form class="col s6" id="store-news-form" action="/admin/greetings" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s12">
                    <input value="" name="greetings-title-input" id="greetings-title-input" type="text" class="validate" required>
                    <label class="active" for="greetings-title-input">Название</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="greetings-body-input" class="materialize-textarea" name="greetings-body-input" required></textarea>
                    <label for="greetings-body-input">Содержание</label>
                </div>

                <div class="input-field col s12">
                    <input value="" id="greetings-btn-input" name="greetings-btn-input" type="text" class="validate" required>
                    <label class="active" for="source">Кнопка</label>
                </div>
            </div>
            <div style="margin-top: 30px; margin-left: 15px;">
                <button type="submit" class="waves-effect waves-light btn" style="background-color: #ff8905" id="store-news">Сохранить</button>
            </div>
        </form>

        <div class="col s6">
            <div class="col s12">
                <div class="card" style="word-wrap:break-word">
                    <div class="card-content">
                        <span class="card-title" id="greetings-title"></span>
                        <p class="" id="greetings-body"></p>
                    </div>
                    <div class="card-action">
                        <button type="submit" class="waves-effect waves-light btn" style="background-color: #ff8905; display: none;" id="greetings-btn"></button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection