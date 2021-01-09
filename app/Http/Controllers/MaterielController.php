<?php

namespace App\Http\Controllers;

use App\Materiel;
use App\Arrivage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MaterielController extends Controller
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
        $mat =Materiel::where('user_id', Auth::id())->get();
        $l_password = $request["l_password"];
        return view('materials.index', compact('mat','l_password'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $labo = $request["labo_id"];
        $l_password = $request["l_password"];
        // dd($l_password);
        return view('materials.create', compact('labo','l_password')  );
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
            'title' => ['required', 'string', 'max:255'],
            'photo' =>  'required|image',
            'labo_id'=> 'required'
           ]);


        $photo = $request->photo;
        $newPhoto = time().$photo->getClientOriginalName();
        $photo->move('uploads/materials',$newPhoto);

        $mat =  Materiel::create([
            'title' => $request->title ,
            'photo' => $newPhoto ,
            'labo_id'=> $request->labo_id,
            'user_id' => Auth::id(),

        ]);


        $mat->save();

        $labo = $request["labo_id"];
        $l_password = $request->l_password;

        // dd($l_password);
        // Session::put('l_password', $l_password);



        return redirect()->route('labos.show', [$labo, 'l_password'=> $l_password]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mat = Materiel::find($id);

        // $arrs = Materiel::where('mat_id'  , $id )->get();
        // dd($arrs);

        $arrs = Arrivage::where('mat_id'  , $id )->where('user_id', Auth::id())->get();

        return view('arrives.index')->with('mat',$mat)
        ->with('arrs',$arrs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mat = Materiel::find( $id ) ;
        return view('materials.edit',compact('mat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mat = Materiel::find( $id ) ;
        $this->validate($request,[
            'title' => 'required',

        ]);
        $mat->title = $request->title;


        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time().$photo->getClientOriginalName();
            $photo->move('uploads/materials',$newPhoto);
            $mat->photo = $newPhoto ;
        }

        $mat->save();

        $labo =$mat->labo_id;


        return redirect()->route('labos.show', $labo) ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Materiel::where('id', $id)->delete();
        return response()->json(['status' => '!تمت عملية الحذف بنجاح']);


    }
}
