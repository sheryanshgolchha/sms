<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Wallet;

class WalletC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallet=DB::table('registrations')
        ->select()
        ->join('wings','wings.wing_id','=','registrations.wing_id')
        ->join('wallets','wallets.reg_id','=','registrations.reg_id')
        ->where(['status' => 0])
        ->get();
        return view('wallet',['wallet'=>$wallet]);
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
          'amount' => 'required|numeric|min:1',
        ]);
        $wallet=DB::table('wallets')
        ->where('wallet_id', $request->post('wallet_id'))
        ->increment('amount', $request->post('amount'));

        $wallet = Wallet::where('wallet_id', $request->post('wallet_id'))->get();
        $data=DB::select('select email from registrations where reg_id = ?', [$wallet[0]->reg_id]);
        $msg='your <b>Rs.'.$request->post('amount').' is Added</b><br><br>Wallet Ballance : <b>Rs.'.$wallet[0]->amount.'</b>';
        $details = [
            'title' => 'Money Added In Wallet',
            'body' => $msg
        ];
   
        \Mail::to($data[0]->email)->send(new \App\Mail\MyTestMail($details));
        return response()->json(['code'=>200, 'message'=>'amount added successfully','data' => $wallet], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wallet = Wallet::where('wallet_id', $id)->get();
        return response()->json($wallet);
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
