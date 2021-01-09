<?php

namespace App\Http\Controllers;

use App\Labo;
use App\Materiel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LaboController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labos = Labo::where('user_id', Auth::id())->orderBy('created_at' , 'DESC')->get();
        return view('labos.index' ,compact('labos') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('labos.create'  );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => ['required', 'string', 'max:255'],
            'photo' =>  'required|image',
            'l_password' => ['required', 'string', 'min:8', 'confirmed'],


           ]);


        $photo = $request->photo;
        $newPhoto = time().$photo->getClientOriginalName();
        $photo->move('uploads/labos',$newPhoto);

        $labo =  Labo::create([
            'name' => $request->name ,
            'photo' => $newPhoto ,
            'l_password' => Hash::make($request->l_password ),
            'user_id' => Auth::id(),
        ]);

        $labo->save();

        return redirect()->route('labos.index') ;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Labo  $labo
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $labo = Labo::find($id);

        $mats = Materiel::orderBy('created_at' , 'DESC')->where('labo_id'  , $id )->where('user_id', Auth::id())->get();
        // dd($mats);


        $l_pwd = $request['l_password'];

        // $lpwd = $request->lpassword;

        // dd(Hash::check($value, $labo->l_password) );
        // dd($l_pwd);

        if (Hash::check($l_pwd, $labo->l_password)) {
            return view('materials.index')->with('labo',$labo)
        ->with('mats',$mats)->with('l_password', $l_pwd);
        }else {
            return redirect()->back();
        }





    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Labo  $labo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $labo = Labo::find( $id ) ;
        return view('labos.edit',compact('labo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Labo  $labo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $labo = Labo::find( $id ) ;
        $this->validate($request,[
            'name' => 'required',

        ]);
        $labo->name = $request->name;

        if ($request->has('l_password')) {
            $labo->l_password = Hash::make($request->l_password);
            $labo->save();
        }

        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time().$photo->getClientOriginalName();
            $photo->move('uploads/labos',$newPhoto);
            $labo->photo = $newPhoto ;
        }

        $labo->save();
        return redirect()->route('labos.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Labo  $labo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Labo::where('id', $id)->delete();
        return response()->json(['status' => '!تمت عملية الحذف بنجاح']);
        // return ('deleted');
    }
}
