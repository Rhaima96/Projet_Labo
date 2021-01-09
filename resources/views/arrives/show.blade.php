@extends('layouts.app')

@section('content')

        <div class="container-fluid">
            <div class="row">
                <div class="col text-center" style="background: #f2cc5d;padding-bottom: 13px;padding-top: 6px;">
                    <h1>بطاقة مخزون<br></h1>
                </div>
            </div>


            <div class="row mb-5">
                <div class="col">

                    <div class="text-center mt-5">
                        <img src="{{asset('uploads/outils/' . $arr->photo)}}" class="rounded" alt="..." width="300px">
                      </div>

                </div>
            </div>



            <div class="row" >
                <div class="col">
                    <div class="table-responsive table-bordered">
                        <table class="table table-bordered table-hover table-dark">
                            <thead>
                                <tr>
                                    <th colspan="7">Ref:&nbsp;{{$arr->ref}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7">Matériels de laboratoire</td>
                                </tr>
                                <tr>
                                    <th>N/IV</th>
                                    <th>DATE</th>
                                    <th>QTE</th>
                                    <th>NBS</th>
                                    <th>RS</th>
                                    <th>OBSERVATION</th>
                                    <th>Modifier</th>
                                </tr>

                                <tr>
                                    <td>{{$arr->nv}} </td>
                                    <td>{{$arr->date->format('d-m-Y')}} </td>
                                    <td>{{$arr->qte}} </td>
                                    <td>{{$arr->nbs}} </td>
                                    <td>{{$arr->rs}} </td>
                                    <td>{{$arr->observation}} </td>

                                    <td class="d-flex">

                                                <a class="btn btn-warning" role="button"
                                            style="margin-left: 9px;" href="{{route('arrives.edit', $arr->id)}}"><i class="fa fa-edit" style="font-size: 24px;"></i></a>




                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


@endsection
