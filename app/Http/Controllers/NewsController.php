<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Exception;
use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Filesystem\Filesystem;

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
        $news =  News::all();
        foreach ($news as $row) {
            $row->img_path = isset($row->img_path) && !empty($row->img_path) ? Storage::disk('s3')->url($row->img_path) : null;
        }
        return view('news.index', ['news' => $news]);
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
            $image = $request->file('card_img');
            $imageFileName = time() . '.' . $image->getClientOriginalExtension();

            $s3 = Storage::disk('s3');
            $filePath = $imageFileName;
            $s3->put($filePath, file_get_contents($image), 'public');
            $news->img_path = $filePath;
        } else {
            $news->img_path = null;
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

        $news = News::findOrFail($id);
        $img = null;
        try{
            if ($news->img_path !== null && !empty($news->img_path)) {
                $img = Storage::disk('s3')->url($news->img_path);
            }
        } catch (Exception $e) {
            dd($e);
        }
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
        $news = News::findOrFail($id);
        try{
            if (isset($news->img_path) && !empty($news->img_path)) {
                $img = Storage::disk('s3')->url($news->img_path);
            } else {
                $img = null;
            }
        } catch (Exception $e) {
            dd($e);
        }

        return view('news.edit', ['news' => $news, 'img' => $img]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateNews(Request $request)
    {
        $validatedData = $request->validate([
            //'card-title-input' => 'required',
            //'card-body-input' => 'required',
            //'card-source-input' => 'required',
        ]);

        $news = [];
        Auth::user()->authorizeRoles(['admin']);

        if(News::where('id', $request->input('news_id'))->exists()) {
            $img_path = News::where('id', $request->input('news_id'))->first()->img_path;

                if(!is_null($request->card_img)) {
                    $image = $request->file('card_img');
                    $imageFileName = time() . '.' . $image->getClientOriginalExtension();

                    $s3 = Storage::disk('s3');
                    $filePath = $imageFileName;
                    $s3->put($filePath, file_get_contents($image), 'public');
                    $path = $filePath;
                } else {
                    $path = isset($img_path) ? $img_path : null;
                }

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

    public function destroyNews($id)
    {
        if(News::where('id', $id)->exists()) {
            $news = News::find($id);
            if (isset($news->img_path) && !empty($news->img_path)) {
                Storage::disk('s3')->delete($news->img_path);
            }
            News::destroy($id);

            return response()->json(['success' => 'success'], 200);
        }
    }

    public function deleteImg($id)
    {
        $news = News::find($id);

        if (isset($news->img_path) && !empty($news->img_path)) {
            Storage::disk('s3')->delete($news->img_path);

            $news->img_path = null;
            $news->save;
        }

        return 1;
    }

    public function newsCardImage($image)
    {
        try {
            dd(Storage::get('storage/'.$image));
            //dd( Storage::url('zFi0mS4NT3klbCx7VQ9oLyxTsY0AWoaHkOs2NZWS.jpeg'));
            //dd(scandir('/app/storage/app/public'));
            //return Image::make(public_path('storage/' . $image))->response();
        } catch(\Exception $e) {
            echo "<pre>";
            echo $e;
            echo "</pre>";
        }
        return Image::make('/storage' . '/' . $image)->response();
    }
}
