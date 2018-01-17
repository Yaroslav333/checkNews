@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <div class="row" style="margin-top: 20px;">
        <form class="col s6" id="update-news-form" action="/admin/news/{{$news->id}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" id="news_id" name="news_id" value="{{$news->id}}">
            <div class="row">
                <div class="input-field col s12">
                    <input value="{{$news->title}}" name="card-title-input" id="card-title-input" type="text" class="validate">
                    <label class="active" for="first_name2">Название</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="card-body-input" class="materialize-textarea" name="card-body-input" >{{$news->body}}</textarea>
                    <label for="card-body-input">Содержание</label>
                </div>
                <div class="file-field input-field col s12">
                    <div class="btn" style="background-color: #ff8905">
                        <span>Картинка</span>
                        <input type="hidden" name="MAX_FILE_SIZE" value="7000000" />
                        <input type="file" id="card-img-input" name="card_img">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" value="{{substr($news->img_path, 5)}}">
                    </div>
                </div>
                <div class="input-field col s12">
                    <input value="{{$news->source}}" id="card-source-input" name="card-source-input" type="text" class="validate">
                    <label class="active" for="source">Ссылка на Источник</label>
                </div>

                <div class="input-field col s12">
                    <input value="{{$news->message}}" id="card-message-input" name="card-message-input" type="text" class="validate" required>
                    <label class="active" for="card-message-input">Сообщение</label>
                </div>

                <div class="col s12">
                    <p>
                        <input type="checkbox" class="filled-in" id="is_true" name="is_true" @if($news->is_true == 1) checked="checked" @endif />
                        <label for="is_true">Правдива ли новость?</label>
                    </p>
                </div>
                <div class="col s12">
                    <p>
                        <input type="checkbox" class="filled-in" id="active_news" name="active_news" @if($news->active == 1) checked="checked" @endif />
                        <label for="active_news">Активна ли новость?</label>
                    </p>
                </div>
            </div>
            <div style="margin-top: 30px; margin-left: 15px;">
                <button type="submit" class="waves-effect waves-light btn" style="background-color: #ff8905" id="store-news">Сохранить</button>
            </div>
        </form>

        <div class="col s6">
            <div class="col s12 m12 card white darken-1" style="overflow-y:auto; max-height:400px;min-height: 400px;border-radius: 7px; position: relative">
                <div class="card-content">
                    <div class="" style="word-wrap:break-word">
                        <h5 class="" id="card-title">{{$news->title}}</h5>
                        <div class="col s12 m12 l12"><img id="card-img" src="{{ $img }}" alt="" class="rightimg"></div>
                        <p id="card-body">{{$news->body}}</p>
                    </div>
                </div>
                <div class="" style="margin-bottom: 10px; margin-top: 10px">
                    @if(isset($news->source) && !empty($news->source))
                    <a href="{{$news->source}}" id="card-source" target="_blank">{{$news->source}}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
