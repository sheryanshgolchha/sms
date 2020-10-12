<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use App\Wing;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Wallet;

class RegistrationC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wings=Wing::all();
        return view('register',['wings'=>$wings]);
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
        $this->validate($request, 
            [
                'fname' => 'required|regex:/^[a-zA-Z]+$/u|max:15',
                'lname' =>'required|regex:/^[a-zA-Z]+$/u|max:15',
                'pwd' =>    'required|min:8|max:15',
                'cnfpwd' =>    'required|min:8|max:15|same:pwd',
                'userphoto' => 'required|image',
                'email' => 'required|email|unique:registrations',
                'phone' => 'required|digits:10|numeric',
                'wing' => 'required|numeric',
                'flatno' => 'required|numeric',
                'idphoto' => 'required|image'
            ],
            [
                'fname.required' => 'First Name is required',
                'fname.regex' => 'First Name must be alphabet',
                'fname.max' => 'First Name must have maximum 15 character',
                'lname.required' => 'Last Name is required',
                'lname.regex' => 'Last Name must be alphabet',
                'lname.max' => 'Last Name must have maximum 15 character',
                'pwd.required' => 'Password is required',
                'pwd.min' => 'Password must be at least 8 characters',
                'pwd.max' => 'Password may not be greater than 15 Characters',
                'cnfpwd.required' => 'Confirm Password is required',
                'cnfpwd.min' => 'Confirm Password must be at least 8 characters',
                'cnfpwd.max' => 'Confirm Password may not be greater than 15 Characters',
                'cnfpwd.same' => 'Confirm Password and Password must match',
                'userphoto.required' => 'Your Photo is required',
                'userphoto.image' => 'Your Photo must be an image', 
                'email.required' => 'Email is required',
                'email.email' => 'Email is not valid',
                'email.unique' => 'Email is already registered',
                'phone.required' => 'Mobile Number is required',
                'phone.digits' => 'Mobile Number must be of 10 digits',
                'phone.numeric' => 'Mobile Number must be number',
                'wing.required' => 'Please select wing',
                'wing.numeric' => 'Please select wing',
                'flatno.required' => 'Flat Number is required',
                'flatno.numeric' => 'Flat Number is not valid',
                'idphoto.required' => 'Your Id Proof is required',
                'idphoto.image' => 'Your Id Proof must be an image'
            ]
        );
        //for user photo
        $file=$request->file('userphoto');
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
        $userphoto=$original_file;
        //for user id proof
        $file=$request->file('idphoto');
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
        $idphoto=$original_file;
        //entry data in databse
        $reg=new Registration([
            'fname' => $request->post('fname'),
            'lname' => $request->post('lname'),
            'password' => Hash::make($request->post('pwd')),
            'photo' => $userphoto,
            'email' => $request->post('email'),
            'phone' => $request->post('phone'),
            'wing_id' => $request->post('wing'),
            'flat_no' => $request->post('flatno'),
            'id_proof' => $idphoto,
            'category' => 2,
            'status' => 1
        ]);
        $reg->save();
        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function society_member()
    {
        $sm=DB::table('registrations')
        ->select()
        ->join('wings','wings.wing_id','=','registrations.wing_id')
        ->where(['status' => 0])
        ->get();
        return view('society_member',['sm'=>$sm]);
    }

    public function verify_society_member()
    {
        $sm=DB::table('registrations')
        ->select()
        ->join('wings','wings.wing_id','=','registrations.wing_id')
        ->where(['status' => 1])
        ->get();
        return view('verify_society_member',['sm'=>$sm]);
    }
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
        $reg = Registration::where('reg_id', $id)->get();
        $cnfreg = Registration::where('wing_id',$reg[0]->wing_id)->where('flat_no',$reg[0]->flat_no)->where('status',0)->get();
        if($cnfreg->isEmpty())
        {
            $reg=Registration::updateOrCreate(['reg_id'=>$id],['status'=>0]);
        }
        else
        {
            $this->destroy($cnfreg[0]->reg_id);
            $reg=Registration::updateOrCreate(['reg_id'=>$id],['status'=>0]);  
        }
        $wallet=Wallet::updateOrCreate(['wallet_id'=>''],[
            'reg_id'=>$reg->reg_id,
            'amount'=>0
        ]);
        return response()->json(['success'=>$reg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reg = Registration::find($id)->delete();
        return response()->json(['success'=>'Post Deleted successfully']);
    }

    public function chk_login(Request $request)
    {

        $this->validate($request,
        [
            'email' => 'required',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email Id is required',
            'password.required' => 'Password is required'
        ]
        );
       // $udata = Registration::where('email','=',$request->post('email'))->first();
        $udata=DB::select('select * from registrations where email = ? and status = ?', [$request->post('email'),0]);
        if($udata==null)
        {
            return redirect('login')->with('error','Username or Password is incorrect');
        }
        else
        {
            if(Hash::check($request->post('password'), $udata[0]->password))
            {
                $request->session()->put('udata',$udata[0]);
                /*$ses_data=$request->session()->get('udata');
                print_r($ses_data->fname);
                die();*/
                return redirect('admin');
            }
            else
            {
                return redirect('login')->with('error','Username or Password is incorrect');
            }
        }
     //   print_r($udata);
    }
}
