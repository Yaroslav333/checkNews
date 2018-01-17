@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <div class="row" style="margin-top: 20px;">
    <form class="col s6" id="store-news-form" action="/admin/news" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="row">
        <div class="input-field col s12">
            <input value="" name="card-title-input" id="card-title-input" type="text" class="validate">
            <label class="active" for="first_name2">Название</label>
        </div>
        <div class="input-field col s12">
            <textarea id="card-body-input" class="materialize-textarea" name="card-body-input"></textarea>
            <label for="textarea1">Содержание</label>
        </div>
        <div class="file-field input-field col s12">
            <div class="btn" style="background-color: #ff8905">
                <span>Картинка</span>
                <input type="hidden" name="MAX_FILE_SIZE" value="7000000" />
                <input type="file" id="card-img-input" name="card_img">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
        <div class="input-field col s12">
            <input value="" id="card-source-input" name="card-source-input" type="text" class="validate">
            <label class="active" for="source">Ссылка на Источник</label>
        </div>

        <div class="input-field col s12">
            <input value="" id="card-message-input" name="card-message-input" type="text" class="validate" required>
            <label class="active" for="card-message-input">Сообщение</label>
        </div>
        <div class="col s12">
            <p>
                <input type="checkbox" class="filled-in" id="is_true" name="is_true" checked="checked" />
                <label for="is_true">Правдива ли новость?</label>
            </p>
        </div>
        <div class="col s12">
            <p>
                <input type="checkbox" class="filled-in" id="active_news" name="active_news" checked="checked" />
                <label for="active_news">Активна ли новость?</label>
            </p>
        </div>

    </div>
        <div style="margin-top: 30px; margin-left: 15px;">
            <button type="submit" class="waves-effect waves-light btn" style="background-color: #ff8905" id="store-news">Сохранить</button>
        </div>
    </form>

        <div class="col s6">
            <div class="col s12 m12 card white darken-1" style="overflow-y:auto; max-height:400px; min-height: 400px;border-radius: 7px; position: relative">
                <div class="card-content">
                    <div class="" style="word-wrap:break-word">
                        <h5 class="" id="card-title"></h5>
                        <p><img id="card-img" src="{{$img}}" alt="" class="rightimg" style="display: none; width: 100%;">
                            <p id="card-body"></p>
                        </p>
                    </div>
                </div>
                <div class="" style="margin-bottom: 10px; margin-top: 10px">
                    <a href="#" id="card-source" target="_blank"></a>
                </div>
            </div>
        </div>

    </div>
@endsection