<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wing;
class WingC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wings=Wing::all();

        return view('wing',['wings'=>$wings]);
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
          'wing_name'       => 'required',
          'total_flats' => 'required|numeric',
        ]);
        $wing = Wing::updateOrCreate(['wing_id' => $request->post('wing_id')], [
                  'wing_name' => $request->post('wing_name'),
                  'total_flats' => $request->post('total_flats')
                ]);
        return response()->json(['code'=>200, 'message'=>'Wing Created successfully','data' => $wing], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wing = Wing::where('wing_id', $id)->get();
        return response()->json($wing);
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
        $wing = Wing::find($id)->delete();
        
        return response()->json(['success'=>'Wing Deleted successfully']);
    }
}
