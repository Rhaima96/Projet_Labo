@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col text-center" style="background: #f2cc5d;padding-bottom: 13px;padding-top: 6px;">
            <h1>تعديل&nbsp;أدوات<br></h1>
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
    <form method="post" style="text-align: right;" action="{{route('arrives.update', $arr->id, $arr->mat_id)}} " enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @php
        $selectedValue = ['Kg','L', 'piece'];
        $val = $arr['unite'];
        @endphp
        <div class="form-group"><input class="form-control" type="text" value="{{$arr->ref}} " name="ref"
                placeholder="Rèférence" autofocus="" required="" style="text-align: left;"></div>
        <div class="form-group"><input class="form-control" value="{{$arr->designation}} " type="text"
                name="designation" placeholder="Designation" style="text-align: left;"></div>
        <div class="form-group">
            <div class="form-row">
                <div class="col"><input class="form-control" type="text" value="{{$arr->qte}} " name="qte"
                        placeholder="Quantité" style="text-align: left;"></div>

                <div class="col"><select class="form-control" name="unite">
                        <optgroup label="Unité">
                            @foreach ($selectedValue as $item)
                            <option value="{{$item}}" {{($val== $item) ? 'selected':''}}>{{$item}}
                            </option>
                            @endforeach
                        </optgroup>
                    </select></div>
            </div>
        </div>
        <div class="form-group"><input class="form-control" type="text" value="{{$arr->nv}} " name="nv"
                placeholder="N/IV" style="text-align: left;"></div>
        <div class="form-group"><input class="form-control" type="text" value="{{$arr->nbs}} " name="nbs"
                placeholder="N/BS" style="text-align: left;"></div>
        <div class="form-group"><input class="form-control" value="{{ date('Y-m-d',strtotime($arr->date)) }}"
                type="date" name="date"></div>
        <div class="form-group" style="text-align: left;"><input type="file" name="photo"></div>
        <div class="form-group" style="text-align: left;"><button class="btn btn-primary" type="submit"
                style="background: rgb(242,204,93) !important;color: rgb(0,0,0);">Editer<br></button></div>
    </form>
</div>


@endsection
