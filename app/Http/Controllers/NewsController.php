<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Exception;
use Intervention\Image\Facades\Image;

class NewsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->authorizeRoles(['admin']);
        return view('news.index', ['news' => News::all()]);

        ///newsimg/{{ $news->img_path }}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->authorizeRoles(['admin']);
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            //'card-title-input' => 'required',
            //'card-body-input' => '',
            //'card-source-input' => '',
        ]);
        $news = new News();
        $news->title = $request->input('card-title-input');
        $news->body = $request->input('card-body-input');
        $news->source = $request->input('card-source-input');
        $news->message = $request->input('card-message-input');
        $news->is_true = $request->input('is_true') == 'on' ? 1 : 0;
        $news->active = $request->input('active_news') == 'on' ? 1 : 0;


        if($request->file('card_img')) {
            $path = $request->file('card_img')->store('public');
            $news->img_path = $path;
        } else {
            $news->img_path = null;
        }

        /*$uploaddir =  '/storage/app/';
        $uploadfile = $uploaddir . basename($_FILES['card_img']['name']);

        if (move_uploaded_file($_FILES['card_img']['tmp_name'], $uploadfile)) {
            $news->img_path = $_FILES['card_img']['name'];
        } else {
            $news->img_path = '';
        }
        $news->img_path = $_FILES['card_img']['name'];*/

        $news->save();
        return response($news);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::user()->authorizeRoles(['admin']);

        if(!News::where('id', $id)->exists()) {
            abort(404);
        }

        $news = News::findOrFail($id);
        if ($news->img_path) {
            //$img = Storage::get($news->img_path);
        } else {
            $img = null;
        }
        dd($news);
        return view('news.show', ['news' => $news, 'img' => $img]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->authorizeRoles(['admin']);

        if(!News::where('id', $id)->exists()) {
            abort(404);
        }

        return view('news.edit', ['news' => News::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return 111;
    }


    public function updateNews(Request $request)
    {
        $validatedData = $request->validate([
            //'card-title-input' => 'required',
            //'card-body-input' => 'required',
            //'card-source-input' => 'required',
        ]);

        $news = [];
        Auth::user()->authorizeRoles(['admin']);;


        if(News::where('id', $request->input('news_id'))->exists()) {
            $img_path = News::where('id', $request->input('news_id'))->first()->img_path;

            if($request->file('card_img')) {
                $path = $request->file('card_img')->store('public');
            } else {
                $path =$img_path;
            }

            /*if(isset($_FILES['card_img']['name']) && !empty($_FILES['card_img']['name'])) {
                $uploaddir =  '../public/img/';
                $uploadfile = $uploaddir . basename($_FILES['card_img']['name']);
                if (move_uploaded_file($_FILES['card_img']['tmp_name'], $uploadfile)) {
                    $img_path = '/img/' . $_FILES['card_img']['name'];
                } else {
                    $img_path = null;
                }
            }*/

            $news = News::where('id', $request->input('news_id'))
                ->update(
                    [
                        'title' => $request->input('card-title-input'),
                        'body' => $request->input('card-body-input'),
                        'source' => $request->input('card-source-input'),
                        'message' => $request->input('card-message-input'),
                        'img_path' => $path,
                        'is_true' => $request->input('is_true') == 'on' ? 1 : 0,
                        'active' => $request->input('active_news') == 'on' ? 1 : 0
                    ]
                );

            $news = News::find($request->input('news_id'));
        }

        return response($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 111;
    }

    public function destroyNews($id)
    {
        if(News::where('id', $id)->exists()) {
            News::destroy($id);

            return response()->json(['success' => 'success'], 200);
        }
    }

    public function newsCardImage($image)
    {
        try {
            return Image::make('/storage/app/public' . '/' . $image)->response();
        } catch(\Exception $e) {
            echo "<pre>";
            echo $e;
            echo "</pre>";
        }
        return Image::make('/storage/app/public' . '/' . $image)->response();
    }
}
