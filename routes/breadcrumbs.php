<?php

//Breadcrumbs::for('NewsController@index', function ($trail) {
//    $trail->add('News', action('NewsController@index'));
//});

use App\News;

Breadcrumbs::for('news.index', function ($trail) {
    $trail->add('News', route('news.index'));
});
