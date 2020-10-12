<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_Type;

class Service_TypeC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stype=Service_Type::all();

        return view('service_type',['stype'=>$stype]);
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
          'service_type'       => 'required',
        ]);
        $stype = Service_Type::updateOrCreate(['service_id' => $request->post('service_id')], [
                  'service_type' => $request->post('service_type')
                ]);
        return response()->json(['code'=>200, 'message'=>'Service Created successfully','data' => $stype], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stype = Service_Type::where('service_id', $id)->get();
        return response()->json($stype);
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
        $stype = Service_Type::find($id)->delete();
        
        return response()->json(['success'=>'Service Deleted successfully']);
    }
}
