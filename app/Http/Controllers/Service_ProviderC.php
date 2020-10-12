<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_Provider;
use App\Service_Type;
use DB;

class Service_ProviderC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stype=Service_Type::all();
        $sprovider=DB::table('service__providers')
        ->select()
        ->join('service__types','service__types.service_id','=','service__providers.service_id')
        ->get();

        return view('service_provider',['stype'=>$stype,'sprovider'=>$sprovider]);
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
              'name'       => 'required',
              'photo' => 'required|image',
              'id_proof' => 'required|image',
              'service_id' => 'required',
              'address' => 'required',
              'phone' =>'required|numeric|digits:10'
            ],
            [
                'service_id.required' => 'Service Type is required'
            ]
        );


            $file=$request->file('photo');
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
            $photo=$original_file;


            $file=$request->file('id_proof');
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
            $id_proof=$original_file;
            $sprovider = Service_Provider::updateOrCreate(['service_provider_id' => $request->post('service_provider_id')], [
                      'name' => $request->post('name'),
                      'service_id' => $request->post('service_id'),
                      'phone' => $request->post('phone'),
                      'photo' => $photo,
                      'address' => $request->post('address'),
                      'id_proof' => $id_proof
                    ]);
            $stype=Service_Type::where('service_id', $request->post('service_id'))->get();
            $sprovider['service_id']=$stype[0]->service_type;
            return response()->json(['code'=>200, 'message'=>'Service Provider Created successfully','data' => $sprovider], 200);
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
        $sp = Service_Provider::find($id)->delete();
        
        return response()->json(['success'=>'Service Provider Deleted successfully']);
    }
}
