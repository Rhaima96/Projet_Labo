@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>




<div class="container-fluid mt1">
    <div class="row">
        <div class="col" style="text-align: center;"><img class="img-fluid mt-4"
                src="assets/img/kisspng-flag-of-tunisia-flag-of-el-salvador-flag-of-sierra-flag-tunis-5b19c89d849492.1282012415284164135431.png"
                width="100px">
            <h3>République Tunisienne<br>&nbsp;la ministère de l'Éducation</h3>
        </div>
        <div class="col" style="text-align: center;"><img class="img-fluid"
                src="assets/img/45655338_2044765728894099_37fdfg09088702618664960_o@2x.png" width="210px"></div>
        <div class="col" style="text-align: center;"><img class="img-fluid mt-4"
                src="assets/img/kisspng-flag-of-tunisia-flag-of-el-salvador-flag-of-sierra-flag-tunis-5b19c89d849492.1282012415284164135431.png"
                width="100px">
            <h3>الجمهورية التونسية<br>وزارة التربية</h3>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col d-flex d-xl-flex justify-content-center justify-content-xl-center" style="padding-top: 1%;">
            <form class="shadow-none" method="POST" action="{{ route('register') }}"
                style="background: rgba(255,255,255,0);width: 40%;">
                @csrf

                <div style="text-align: right;"><label>اسم المؤسسة التربوية</label></div>
                <div class="form-group">
                    <div class="input-group mb-3"><input id="name" type="text"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autocomplete="name" autofocus
                            style="border-style: none;border-top-left-radius: 20px;border-bottom-left-radius: 20px;text-align: right;height: 50px;">
                        <div class="input-group-prepend" style="background: rgba(255,255,255,0);"><span
                                class="input-group-text"
                                style="background: #ffffff;border-style: none;border-top-right-radius: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 0px;border-top-left-radius: 0px;height: 50px;"><i
                                    class="fa fa-user" style="font-size: 24px;"></i></span></div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div style="text-align: right;"><label>البريد الالكتروني<br></label></div>
                <div class="form-group">
                    <div class="input-group mb-3"><input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email"
                            style="border-style: none;border-top-left-radius: 20px;border-bottom-left-radius: 20px;text-align: right;height: 50px;">
                        <div class="input-group-prepend" style="background: rgba(255,255,255,0);"><span
                                class="input-group-text"
                                style="background: #ffffff;border-style: none;border-top-right-radius: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 0px;border-top-left-radius: 0px;height: 50px;"><i
                                    class="fa fa-envelope" style="font-size: 24px;"></i></span></div>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div style="text-align: right;"><label>كلمة العبور</label></div>
                <div class="form-group">
                    <div class="input-group mb-3"><input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password"
                            style="border-style: none;border-top-left-radius: 20px;border-bottom-left-radius: 20px;text-align: right;height: 50px;">
                        <div class="input-group-prepend" style="background: rgba(255,255,255,0);"><span
                                class="input-group-text"
                                style="background: #ffffff;border-style: none;border-top-right-radius: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 0px;border-top-left-radius: 0px;height: 50px;"><i
                                    class="fa fa-lock" style="font-size: 24px;"></i></span></div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div style="text-align: right;"><label>تأكيد كلمة العبور</label></div>
                <div class="form-group">
                    <div class="input-group mb-3"><input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required autocomplete="new-password"
                            style="border-style: none;border-top-left-radius: 20px;border-bottom-left-radius: 20px;text-align: right;height: 50px;">
                        <div class="input-group-prepend" style="background: rgba(255,255,255,0);"><span
                                class="input-group-text"
                                style="background: #ffffff;border-style: none;border-top-right-radius: 20px;border-bottom-right-radius: 20px;border-bottom-left-radius: 0px;border-top-left-radius: 0px;height: 50px;"><i
                                    class="fa fa-lock" style="font-size: 24px;"></i></span></div>
                    </div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block shadow" type="submit"
                        style="background: #966525 !important;border-radius: 19px;font-size: 17px;height: 50px;"><strong>تسجيل
                            حساب</strong><br></button></div>
            </form>
        </div>
    </div>
</div>
@endsection
