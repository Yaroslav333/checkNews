@extends('layouts.admin')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <div style="margin-top: 30px; margin-left: 20px;">
        <a href="/admin/news/create" class="waves-effect waves-light btn" style="background-color: #ff8905">Добавить Новость</a>
    </div>

    <div class="row">
        <div class="col m12" style="margin-top: 30px;">
            @if(!empty($news))
                @foreach($news as $item)

                        <div class="col s6 m4 news_box_index" data-loc="{{'/admin/news/' . $item->id}}" onclick="window.location = $(this).data('loc');">
                            <div class="col s12 m11 card news_box_index" style="overflow-y:auto; max-height:400px; min-height: 400px;border-radius: 7px; position: relative">
                                <div class="card-content ">
                                    <div class="" style="word-wrap:break-word">
                                        <h5 class="" id="card-title">{{$item->title}}</h5>
                                        <p><img id="card-img" src="{{$item->img_path}}" alt="" class="rightimg">
                                        <p id="card-body">{{$item->body}}</p>
                                        </p>
                                    </div>
                                </div>
                                <div class="" style="margin-bottom: 10px; margin-top: 10px">
                                    <a href="{{$item->source}}" id="card-source" target="_blank">{{$item->source}}</a>
                                </div>
                            </div>
                        </div>

                @endforeach
            @endif
        </div>
    </div>


@endsection