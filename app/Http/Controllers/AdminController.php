<?php
/**
 * Created by PhpStorm.
 * User: Candy
 * Date: 21.12.2017
 * Time: 23:56
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Swift_Mailer;
use Swift_Message;
use Swift_SendmailTransport;
use Swift_SmtpTransport;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return view('admin.index', ['admin' => $request->user()]);
    }

    public function userList()
    {

    }
}