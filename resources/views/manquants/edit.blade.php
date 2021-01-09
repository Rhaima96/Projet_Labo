@extends('layouts.app')


@section('content')


        <div class="container-fluid">
            <div class="row">
                <div class="col text-center" style="background: #f2cc5d;padding-bottom: 13px;padding-top: 6px;">
                    <h1>تعديل أدوات<br></h1>
                </div>
            </div>
        </div>

        <div class="row w-25 mt-3 ml-3">
            <div class="col w-25">

                  @if (count($errors) > 0)
                  <ul class="list-unstyled">
                      @foreach ($errors->all() as $item)
                      <li>
                        <div class="alert alert-danger" role="alert"> {{$item}}</div>
                      </li>
                      @endforeach
                  </ul>
                  @endif

            </div>
        </div>
        <div class="contact-clean" style="background: #fde8ab;">
            <form method="post" style="text-align: right;" action="{{route('manques.update', $mq->id, $mq->mat_id)}} ">
                @csrf
                @method('PUT')

                @php
                $selectedValue = ['Kg','L', 'Pieces'];
                $val = $mq['unite'];
                @endphp


                <div class="form-group"><input class="form-control" type="text" value="{{$mq->m_manquant}} " name="m_manquant"
                        placeholder="اسم الأداة" style="text-align: right;"></div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col"><input class="form-control" type="text" value="{{$mq->qte}} " name="qte"
                                placeholder="الكمية" style="text-align: right;"></div>
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
                <div class="form-group"><input class="form-control" type="text" value="{{$mq->resp}} " name="resp"
                        placeholder="المسؤول" style="text-align: right;"></div>
                <div class="form-group"><input class="form-control" value="{{ date('Y-m-d',strtotime($mq->date)) }}" type="date"
                        name="date"></div>
                <div class="form-group" style="text-align: right;"><button class="btn btn-primary" type="submit"
                        style="background: rgb(242,204,93) !important;color: rgb(0,0,0);">تعديل<br></button></div>
            </form>
        </div>


@endsection
