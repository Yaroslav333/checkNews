@extends('layouts.game')

@section('title', 'Page Title')

@section('sidebar')
    @parent

@endsection

@section('content')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.11';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    <div class="">
        <div class="row">
            <div class="col s10 m6 offset-s1 offset-m3 valign game_greetings" style=" margin-top: 20px;">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Сможете ли вы отличить фейковые новости от настоящих?</span>
                        <p>Перетащите карточку с новостью вправо или нажмите на кнопку
                            <a class="btn-floating btn-large waves-effect waves-light green" id=""><i class="material-icons">done</i></a>
                        ,если считаете, что новость правдива.
                        </p><br>
                        <p>Перетащите карточку с новостью влево или нажмите на кнопку
                            <a class="btn-floating btn-large waves-effect waves-light red" id="" style="margin-left: 10px;"><i class="material-icons">clear</i></a>
                            ,если считаете, что новость фейковая.
                        </p>
                    </div>
                    <div class="card-action center-align">
                        <button type="submit" class="waves-effect waves-light btn" style="background-color: #ff8905" id="start_game">Начать</button>
                    </div>
                </div>
            </div>


            <div class="col s8 m6 offset-s2 offset-m3 valign game_result_box" style="display: none; margin-top: 20px;">
                <div class="card">
                    <div class="card-content center-align">
                        <span class="card-title">Тест окончен</span>
                        <p id="game-result"></p>
                        <p id="test_result"></p>
                        <hr>
                        <div id="test_info">

                        </div>
                    </div>
                    <div class="card-action col s12 m12 l12">
                        <div style="text-align: center">
                            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false" data-size="large">Tweet</a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                        <div style="text-align: center">
                            <div class="fb-share-button" id="fb-share-button" data-href="" data-layout="button" data-size="large" data-mobile-iframe="false"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">Поделиться</a></div>
                        </div>
                        <div class="right" style="margin-top: 10px;">
                          <a href="/" onclick="location.reload()" style="margin-right: 0px;"><i class="small material-icons">refresh</i></a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col s12 m12 l12 game_news_card">
                <div class="col s1 m2 l2" style="margin-top:220px; text-align: center;">
                    <a class="btn-floating btn-large waves-effect waves-light red" id="fake_icon" style="display: none"><i class="material-icons " id="news_icon" style="line-height: 0px;">Ложь</i></a>
                </div>
                <div class="col s9 m6 l6 offset-m1 offset-l1 valign game_news_card draggable" id="game_news_card" style="display: none; margin-top: 45px;padding-right: 0px;padding-left: 0px;">
                    <div class="col s12 m12 l12 card white darken-1 game_card_content_box" style="overflow-y:auto; height: 400px; border-radius: 7px; position: relative">
                        <div class="card-content " style="padding-left: 0px;padding-right: 0px;padding-top: 10px;">
                            <div class="" style="word-wrap:break-word">
                                <h5 class="" id="game-card-title"></h5>
                                <p><img id="game-card-img" src="" alt="" class="rightimg" style="display: none">
                                <p id="game-card-body"></p>
                                </p>
                            </div>
                        </div>
                        <div class="" style="margin-bottom: 10px; margin-top: 10px">
                            <a href="#" id="game-card-source" target="_blank"></a>
                        </div>
                    </div>
                </div>
                <div class="col s1 m2 l2 offset-m1 offset-l1" style="margin-top:220px;text-align: center;padding-left: 0px;">
                    <a class="btn-floating btn-large waves-effect waves-light green" id="true_icon" style="display: none"><i class="material-icons" id="news_icon" style="line-height: 0px;">Правда</i></a>
                </div>
            </div>

            <div class="col s8 m6 offset-s2 offset-m3 valign card-message-box" style="display: none; margin-top: 20px;">
                <div class="card">
                    <div class="card-content" style="word-wrap:break-word">
                        <span class="card-message-title"></span>
                        <p class="card-message-body"></p>
                    </div>
                    <div class="card-action center-align">
                        <button type="submit" class="waves-effect waves-light btn" style="background-color: #ff8905" id="game_return_btn">Продолжить</button>
                    </div>
                </div>
            </div>


        </div>

    </div>
    <div class="row">
        <div class="col s12 m12 game_button_box" style="display: none">
            <div class="col s6 m6">
                <div class="col s2 m2 l2" style="float: right">
                    <a class="btn-floating btn-large waves-effect waves-light red" id="fake_news_btn" style="float: right"><i class="material-icons">clear</i></a>
                </div>
            </div>
            <div class="col s6 m6">
                <div class="col s3 m3 l2" style="float: left">
                    <a class="btn-floating btn-large waves-effect waves-light green" id="true_news_btn"><i class="material-icons">done</i></a>
                </div>
            </div>
        </div>
    </div>
@endsection