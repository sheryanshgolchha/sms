<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Amenitie;

class AmenitieC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amenities=Amenitie::all();
        return view('amenitie',['amenities'=>$amenities]);
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
        if($request->post('amenitie_id')=='' || ($request->post('amenitie_id')!='' && $request->has('amenitie_photo')))
        {
            $request->validate([
              'amenitie_name'       => 'required',
              'amenitie_photo' => 'required|image',
              'open_time' => 'required',
              'close_time' => 'required',
              'charges' =>'required|numeric',
            ]);
            $file=$request->file('amenitie_photo');
            $cnt=0;
            $original_file=$file->getClientOriginalName();
            $ext=$file->getClientOriginalExtension();
            $fileinfo = pathinfo($original_file);
            $filename = $fileinfo['filename'];
            while(file_exists('uploads/'.$original_file))
            {
                $cnt++;
                $original_file=$filename.$cnt.'.'.$ext;
            }
            $file->move('uploads',$original_file);
            $amenitie_photo=$original_file;
            $amenitie = Amenitie::updateOrCreate(['amenitie_id' => $request->post('amenitie_id')], [
                      'amenitie_name' => $request->post('amenitie_name'),
                      'amenitie_photo' => $amenitie_photo,
                      'open_time' => $request->post('open_time'),
                      'close_time' => $request->post('close_time'),
                      'charges' => $request->post('charges')
                    ]);
        }
        else
        {
            $request->validate([
              'amenitie_name'       => 'required',
              'open_time' => 'required',
              'close_time' => 'required',
              'charges' =>'required|numeric',
            ]);
            $amenitie = Amenitie::updateOrCreate(['amenitie_id' => $request->post('amenitie_id')], [
                      'amenitie_name' => $request->post('amenitie_name'),
                      'open_time' => $request->post('open_time'),
                      'close_time' => $request->post('close_time'),
                      'charges' => $request->post('charges')
                    ]);
        }
        return response()->json(['code'=>200, 'message'=>'Amenitie Created successfully','data' => $amenitie], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $amenitie = Amenitie::where('amenitie_id', $id)->get();
        return response()->json($amenitie);
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
        $amenitie = Amenitie::find($id)->delete();
        
        return response()->json(['success'=>'Amenitie Deleted successfully']);
    }
}
