<?php

namespace App\Http\Controllers;

use App\Panne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanneController extends Controller
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
    public function index(Request $request)
    {
        $mat = $request["mat_id"];

        $pannes = Panne::where('mat_id'  , $mat )->where('user_id', Auth::id())->get();




        return view('pannes.index' )->with('mat', $mat)->with('pannes' , $pannes);
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
        return view('pannes.create', compact('mat')  );
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
            'm_panne' => ['required', 'string', 'max:255'],
            'mat_id'=> 'required',
            'resp'=> 'required',
            'date'=> 'required',
            'qte'=> 'required',
            'unite'=> 'required',


           ]);

        $panne =  Panne::create([
            'm_panne' => $request->m_panne ,
            'mat_id'=> $request->mat_id,
            'resp'=> $request->resp,
            'date'=> $request->date,
            'qte'=> $request->qte,
            'unite'=> $request->unite,
            'user_id' => Auth::id(),


        ]);


        $panne->save();

        $mat = $request["mat_id"];


        return redirect()->route('pannes.index', ['mat_id'=>$mat]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manquant  $manquant
     * @return \Illuminate\Http\Response
     */



    // public function show()
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manquant  $manquant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $panne = Panne::find( $id ) ;
        return view('pannes.edit',compact('panne'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manquant  $manquant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $panne = Panne::find( $id ) ;
        $this->validate($request,[
            'm_panne' => ['required', 'string', 'max:255'],
            'resp'=> 'required',
            'date'=> 'required',
            'qte'=> 'required',
            'unite'=> 'required',

        ]);



        $input = $request->all();

        $panne->fill($input)->save();

        $mat = $panne->mat_id;


        return redirect()->route('pannes.index', ['mat_id'=>$mat]) ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manquant  $manquant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Panne::where('id', $id)->delete();
        return response()->json(['status' => '!تمت عملية الحذف بنجاح']);
    }
}
