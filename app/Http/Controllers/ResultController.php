<?php

namespace App\Http\Controllers;

use App\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results = Result::all();

        $test_results = [];
        foreach ($results as $result) {
            if (isset($result->percent)) {
                $test_results[$result->percent] = $result->body;
            } else {
                $test_results ['info'] = $result->body;
            }
        }
        return view('result.index', ['test_results' => $test_results]);
    }

    public function getTestResult()
    {
        $results = Result::all();

        $test_results = [];
        foreach ($results as $result) {
            if (isset($result->percent)) {
                $test_results[$result->percent] = $result->body;
            } else {
                $test_results ['info'] = $result->body;
            }
        }

        return $test_results;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        return $request;

        try {
            $resultArr = [
                '25' => 'result',
                '50' => 'result',
                '75' => 'result',
                '90' => 'result',
                '100' => 'result'
            ];

            // return $request;

            foreach ($resultArr as $key => $type) {
                if (!Result::where('type', $type)->where('percent', $key)->exists()) {

                    $result = new Result();
                    $result->type = $type;
                    $result->percent = $key;
                    $result->body = $request->input($key . '_' . $type);
                    $result->save();
                } else {
                    Result::where('type', $type)->where('percent', $key)->update(['body' => $request->input($key . '_' . $type)]);
                }
            }

            //final info
            if (!Result::where('type', 'final_info')->exists()) {
                $info = new Result();
                $info->type = 'final_info';
                $info->body = $request->input("final_info");
                $info->save();
            } else {
                Result::where('type', 'final_info')->update(['body' => $request->input("final_info")]);
            }

            $results = Result::all();
            return response($results);

        } catch(\Exception $e) {
            echo "<pre>";
            echo $e;
            echo "</pre>";
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
