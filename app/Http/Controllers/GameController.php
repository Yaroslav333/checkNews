<?php
/**
 * Created by PhpStorm.
 * User: Candy
 * Date: 26.12.2017
 * Time: 22:27
 */

namespace App\Http\Controllers;


use App\News;
use Illuminate\Support\Facades\Storage;
use PHPMailer\PHPMailer\PHPMailer;

class GameController extends Controller
{

    public function index()
    {
        return view('game.index');
    }



    public function getNews()
    {
        $news = News::where('active', 1)->get();
        foreach ($news as $row) {
            $row->img_path = isset($row->img_path) && !empty($row->img_path) ? Storage::disk('s3')->url($row->img_path) : null;
        }
        return response($news);

    }
}