@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <div class="row" style="margin-top: 20px;">
        <div class="col s6">
            <div class="col s12 m7 card white darken-1" style="overflow-y:auto; height:400px;border-radius: 7px; position: relative">
                <div class="card-content">

                    <div class="" style="word-wrap:break-word">
                        <h5 class="" id="card-title">{{$news->title}}</h5>
                        <p><img id="card-img" src="{{$news->img_path}}" alt="" class="rightimg">
                        <p id="card-body">{{$news->body}}</p>
                        </p>
                    </div>
                </div>
                <div class="" style="margin-bottom: 10px; margin-top: 10px">
                    <a href="{{$news->source}}" id="card-source" target="_blank">{{$news->source}}</a>
                </div>
            </div>
        </div>
        <div class="col s6">
            <div class="col s12 m6 mb20">
                <a href="{{'/admin/news/' . $news->id . '/edit'}}" class="waves-effect waves-light btn" style="background-color: #ff8905">Редактировать</a>
            </div>
            <div class="col s12 m6 mb20">

                <!-- Modal Trigger -->
                <a class="waves-effect waves-light btn modal-trigger" href="#modal1" style="background-color: #ff8905">Удалить</a>

                <!-- Modal Structure -->
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4>Данная новость будет удалена.</h4>
                        <p>Вы уверены?</p>
                    </div>
                        <div class="modal-footer">
                            <form  id="delete-news-form" action="/admin/news/delete/{{$news->id}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" id="news_id" name="news_id" value="{{$news->id}}">
                            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat" id="">Удалить</button>
                            {{--<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat" id="delete_news">Удалить</a>--}}
                            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Отмена</a>
                            </form>
                        </div>



                </div>


                {{--<a href="/admin/news/create" class="waves-effect waves-light btn" style="background-color: #ff8905">Удалить</a>--}}
            </div>
        </div>
        <div class="col m12">
            <span>{{'Дата создания: ' . $news->created_at}}</span>
        </div>
    </div>
@endsection
