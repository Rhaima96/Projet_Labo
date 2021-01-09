<?php

namespace App\Http\Controllers;

use App\Detruit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetruitController extends Controller
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

        $dets = Detruit::where('mat_id'  , $mat )->where('user_id', Auth::id())->get();




        return view('detruits.index' )->with('mat', $mat)->with('dets' , $dets);
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
        return view('detruits.create', compact('mat')  );
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
            'm_detruit' => ['required', 'string', 'max:255'],
            'mat_id'=> 'required',
            'resp'=> 'required',
            'date'=> 'required',
            'qte'=> 'required',
            'unite'=> 'required',


           ]);

        $det =  Detruit::create([
            'm_detruit' => $request->m_detruit ,
            'mat_id'=> $request->mat_id,
            'resp'=> $request->resp,
            'date'=> $request->date,
            'qte'=> $request->qte,
            'unite'=> $request->unite,
            'user_id' => Auth::id(),


        ]);


        $det->save();

        $mat = $request["mat_id"];


        return redirect()->route('detruits.index', ['mat_id'=>$mat]) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detruit  $detruit
     * @return \Illuminate\Http\Response
     */
    public function show(Detruit $detruit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detruit  $detruit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $det = Detruit::find( $id ) ;
        return view('detruits.edit',compact('det'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detruit  $detruit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $det = Detruit::find( $id ) ;
        $this->validate($request,[
            'm_detruit' => ['required', 'string', 'max:255'],
            'resp'=> 'required',
            'date'=> 'required',
            'qte'=> 'required',
            'unite'=> 'required',

        ]);



        $input = $request->all();

        $det->fill($input)->save();

        $mat = $det->mat_id;


        return redirect()->route('detruits.index', ['mat_id'=>$mat]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detruit  $detruit
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Detruit::where('id', $id)->delete();
        return response()->json(['status' => '!تمت عملية الحذف بنجاح']);
    }
}
