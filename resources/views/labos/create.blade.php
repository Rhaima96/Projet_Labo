@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col text-center" style="background: #f2cc5d;padding-bottom: 13px;padding-top: 6px;">
            <h1>إضافة مخبر<br></h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
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
        </div>
    </div>
</div>
<div class="contact-clean" style="background: #fde8ab;">
    <form method="post" style="text-align: right;" action="{{route('labos.store')}} " enctype="multipart/form-data">
        @csrf
        <div class="form-group"><input class="form-control" type="text" name="name" placeholder="اسم المخبر"
                autofocus="" required="" style="text-align: right;"></div>
        <div class="form-group"><input class="form-control text-truncate" type="file" name="photo"></div>
        <div class="form-group"><input class="form-control" type="password" placeholder="رمز العبور" name="l_password"
                style="text-align: right;"></div>
        <div class="form-group"><input class="form-control" type="password" placeholder=" تأكيد رمز العبور"
                name="l_password_confirmation" style="text-align: right;"></div>
        <div class="form-group"><button class="btn btn-primary" type="submit"
                style="background: rgb(242,204,93) !important;color: rgb(0,0,0);font-family: 'Sawarabi Gothic', sans-serif;font-size: 17px;"><strong>أضف</strong></button>
        </div>
    </form>
</div>


@endsection
