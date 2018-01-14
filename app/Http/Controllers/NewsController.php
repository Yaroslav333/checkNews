<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;

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
            'card-title-input' => 'required',
            'card-body-input' => 'required',
            'card-source-input' => 'required',
        ]);
        $news = new News();
        $news->title = $request->input('card-title-input');
        $news->body = $request->input('card-body-input');
        $news->source = $request->input('card-source-input');
        $news->message = $request->input('card-message-input');
        $news->is_true = $request->input('is_true') == 'on' ? 1 : 0;
        $news->active = $request->input('active_news') == 'on' ? 1 : 0;

        $uploaddir =  '../public/img/';
        $uploadfile = $uploaddir . basename($_FILES['card_img']['name']);

        if (move_uploaded_file($_FILES['card_img']['tmp_name'], $uploadfile)) {
            $news->img_path = '/img/' . $_FILES['card_img']['name'];
        } else {
            $news->img_path = '/img/' . '300.png';
        }
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

        return view('news.show', ['news' => News::findOrFail($id)]);
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
            'card-title-input' => 'required',
            'card-body-input' => 'required',
            'card-source-input' => 'required',
        ]);

        $news = [];
        Auth::user()->authorizeRoles(['admin']);;


        if(News::where('id', $request->input('news_id'))->exists()) {
            $img_path = '/img/' . '300.png';
            if(isset($_FILES['card_img']['name'])) {
                $uploaddir =  '../public/img/';
                $uploadfile = $uploaddir . basename($_FILES['card_img']['name']);

                if (move_uploaded_file($_FILES['card_img']['tmp_name'], $uploadfile)) {
                    $img_path = '/img/' . $_FILES['card_img']['name'];
                } else {
                    $img_path = '/img/' . '300.png';
                }
            }

            $news = News::where('id', $request->input('news_id'))
                ->update(
                    [
                        'title' => $request->input('card-title-input'),
                        'body' => $request->input('card-body-input'),
                        'source' => $request->input('card-source-input'),
                        'message' => $request->input('card-message-input'),
                        'img_path' => $img_path,
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
}
