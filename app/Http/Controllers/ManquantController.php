<?php

namespace App\Http\Controllers;

use App\Manquant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManquantController extends Controller
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

        $mqs = Manquant::where('mat_id'  , $mat )->where('user_id', Auth::id())->get();




        return view('manquants.index' )->with('mat', $mat)->with('mqs' , $mqs);
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
        return view('manquants.create', compact('mat')  );
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
            'm_manquant' => ['required', 'string', 'max:255'],
            'mat_id'=> 'required',
            'resp'=> 'required',
            'date'=> 'required',
            'qte'=> 'required',
            'unite'=> 'required',


           ]);

        $mq =  Manquant::create([
            'm_manquant' => $request->m_manquant ,
            'mat_id'=> $request->mat_id,
            'resp'=> $request->resp,
            'date'=> $request->date,
            'qte'=> $request->qte,
            'unite'=> $request->unite,
            'user_id' => Auth::id(),


        ]);


        $mq->save();

        $mat = $request["mat_id"];


        return redirect()->route('manques.index', ['mat_id'=>$mat]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manquant  $manquant
     * @return \Illuminate\Http\Response
     */
    public function show(Manquant $manquant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manquant  $manquant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mq = Manquant::find( $id ) ;
        return view('manquants.edit',compact('mq'));
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
        $mq = Manquant::find( $id ) ;
        $this->validate($request,[
            'm_manquant' => ['required', 'string', 'max:255'],
            'resp'=> 'required',
            'date'=> 'required',
            'qte'=> 'required',
            'unite'=> 'required',

        ]);



        $input = $request->all();

        $mq->fill($input)->save();

        $mat = $mq->mat_id;


        return redirect()->route('manques.index', ['mat_id'=>$mat]) ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manquant  $manquant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Manquant::where('id', $id)->delete();
        return response()->json(['status' => '!تمت عملية الحذف بنجاح']);
    }
}
