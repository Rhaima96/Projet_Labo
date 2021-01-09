@extends('layouts.app')

@section('content')


        <div class="container-fluid">
            <div class="row">
                <div class="col text-center" style="background: #f2cc5d;padding-bottom: 13px;padding-top: 6px;">
                    <h1>إضافة أدوات<br></h1>
                </div>
            </div>
        </div>
        @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $item)
            <li>
                {{$item}}
            </li>
            @endforeach
        </ul>
        @endif
        <div class="contact-clean" style="background: #fde8ab;">
            <form method="post" style="text-align: right;" action="{{route('arrives.store')}} " enctype="multipart/form-data">
                @csrf

                <div class="form-group"><input class="form-control" type="text" name="ref" placeholder="Rèférence" autofocus=""
                        required="" style="text-align: left;"></div>
                <div class="form-group"><input class="form-control" type="text" name="designation" placeholder="Designation"
                        style="text-align: left;"></div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col"><input class="form-control" type="text" name="qte" placeholder="Quantité"
                                style="text-align: left;"></div>
                        <div class="col"><select class="form-control" name="unite">
                                <optgroup label="Unité">
                                    <option value="Kg">Kg</option>
                                    <option value="L">L</option>
                                    <option value="piece">Piéce</option>
                                </optgroup>
                            </select></div>
                    </div>
                </div>
                <div class="form-group"><input class="form-control" type="text" name="nv" placeholder="N/IV"
                        style="text-align: left;"></div>
                <div class="form-group"><input class="form-control" type="text" name="nbs" placeholder="N/BS"
                        style="text-align: left;"></div>
                        <div class="form-group"><input class="form-control" type="text" name="rs" placeholder="RS"
                            style="text-align: left;"></div>
                            <div class="form-group"><input class="form-control" type="text" name="observation" placeholder="Observation"
                                style="text-align: left;"></div>
                        <div class="form-group"><input class="form-control" type="hidden"
                            style="text-align: left;" name="mat_id" value="{{$mat}}"></div>
                <div class="form-group"><input class="form-control" type="date" name="date"></div>
                <div class="form-group"><input class="form-control text-truncate" type="file" name="photo"></div>
                <div class="form-group" style="text-align: left;"><button class="btn btn-primary" type="submit"
                        style="background: rgb(242,204,93) !important;color: rgb(0,0,0);">ajouter<br></button></div>

            </form>
        </div>


@endsection
