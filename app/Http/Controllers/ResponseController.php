<?php

namespace App\Http\Controllers;

use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(Response $response)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function edit($interview_id)
    {
        $interview = Response::where ('interview_id', $interview_id)->first();
        $interviewId = $interview_id;
        return view('response', compact('interview', 'interviewId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $interview_id)
    {
        $request->validate([
            'status'=>'required',
        ]);

        if ($request->status == 'ditolak'){ 
            $schedule = NULL;
        }else{
            $schedule = $request->schedule;
        }    

        Response::updateOrCreate(
            [
                'interview_id' => $interview_id,
            ],
            [
                'status' => $request->status,
                'schedule' => $schedule,
            ]
            );

        return redirect()->route('data.petugas')->with('responseSuccess', 'Success give response!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function destroy(Response $response)
    {
        //
    }
}
