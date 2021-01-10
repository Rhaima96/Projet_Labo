<?php

namespace App\Http\Controllers;

use App\Arrivage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArrivageController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $mat = $request["mat_id"];
        // dd($mat);
        return view('arrives.create', compact('mat')  );
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
            'ref' => ['required', 'string', 'max:255'],
            'photo' =>  'required|image',
            'mat_id'=> 'required',
            'designation'=> 'required',
            'date'=> 'required',
            'qte'=> 'required',
            'unite'=> 'required',
            'nv'=> 'required',
            'nbs'=> 'required',
            'rs'=> 'required',
            'observation'=> 'required',


           ]);


        $photo = $request->photo;
        $newPhoto = time().$photo->getClientOriginalName();
        $photo->move('uploads/outils',$newPhoto);

        $arr =  Arrivage::create([
            'ref' => $request->ref ,
            'photo' => $newPhoto ,
            'mat_id'=> $request->mat_id,
            'designation'=> $request->designation,
            'date'=> $request->date,
            'qte'=> $request->qte,
            'unite'=> $request->unite,
            'nv'=> $request->nv,
            'nbs'=> $request->nbs,
            'rs'=> $request->rs,
            'observation'=> $request->observation,
            'user_id' => Auth::id(),

        ]);


        $arr->save();

        $mat = $request["mat_id"];


        return redirect()->route('materiels.show', $mat) ;
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Arrivage  $arrivage
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $arr= Arrivage::find($id) ;



        // dd($arr);
        return view('arrives.show')
        ->with('arr',$arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Arrivage  $arrivage
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arr = Arrivage::find( $id ) ;
        return view('arrives.edit',compact('arr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Arrivage  $arrivage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $arr = Arrivage::find( $id ) ;
        $this->validate($request,[
            'ref' => ['required', 'string', 'max:255'],
            'designation'=> 'required',
            'date'=> 'required',
            'qte'=> 'required',
            'unite'=> 'required',
            'nv'=> 'required',
            'nbs'=> 'required',

        ]);



        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time().$photo->getClientOriginalName();
            $photo->move('uploads/outils',$newPhoto);
            $arr->photo = $newPhoto ;
        }

        $input = $request->all();

        $arr->fill($input)->save();

        $mat =$arr->mat_id;


        return redirect()->route('materiels.show', $mat) ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Arrivage  $arrivage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Arrivage::where('id', $id)->delete();
        return response()->json(['status' => '!تمت عملية الحذف بنجاح']);
    }
}
