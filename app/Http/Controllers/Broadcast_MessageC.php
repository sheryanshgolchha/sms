<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Broadcast_Message;
use DB;
class Broadcast_MessageC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bmessage=Broadcast_Message::all();

        return view('broadcast_message',['bmessage'=>$bmessage]);
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
        $request->validate([
          'message'       => 'required',
        ]);
        $udata=$request->session()->get('udata');
        $sec_id=$udata->reg_id;
        $smessage = Broadcast_Message::updateOrCreate(['broadcast_message_id' => $request->post('broadcast_message_id')], [
                  'secretary_id' => $sec_id,
                  'message' => $request->post('message')
                ]);

        $data=DB::select('select email from registrations where status = ?', [0]);
        foreach ($data as $d) 
        {
        
            $details = [
                'title' => 'Broadcast Message',
                'body' => $request->post('message')
            ];
       
            \Mail::to($d->email)->send(new \App\Mail\MyTestMail($details));
        }

        return response()->json(['code'=>200, 'message'=>'message sent successfully','data' => $smessage], 200);

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
