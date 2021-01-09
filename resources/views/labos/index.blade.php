@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col text-center" style="background: #f2cc5d;padding-bottom: 13px;padding-top: 6px;">
            <h1>المخابر</h1>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-end"><a class="btn btn-primary btn-lg" role="button"
                href="{{route('labos.create')}} "
                style="background: #966525;border-radius: 23px;margin-top: 10px;margin-bottom: 13px;border-style: none;">إضافة</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row row-cols-1 row-cols-md-3">
                @foreach ($labos as $labo)
                <div class="col mb-4">

                    <div class="card" style="background: rgb(242,204,93);">
                        <img src="{{asset('uploads/labos/' . $labo->photo)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title text-center">{{$labo->name}}</h3>
                            <div class="d-flex justify-content-center mt-4">
                                {{-- <a class="btn btn-primary" href="">تصفح</a> --}}
                                <button class="btn btn-primary" data-laboid="{{$labo->id}} " data-toggle="modal"
                                    data-target="#modal1" type="button">تصفح<br></button>

                                <div class="modal fade" role="dialog" tabindex="-1" id="modal1">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background: #f2cc5d;">
                                                <h4 class="modal-title" style="margin-left: 136px;">أدخل رمز العبور</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action=" " id="show" method="get">
                                                    @csrf
                                                    @method('HEAD')


                                                    {{-- <input type="hidden" name="laboid" id="labos_id" value=""> --}}
                                                    <div class="form-group"><input class="form-control-lg"
                                                            type="password" required="" autofocus=""
                                                            style="width: 100%;" name="l_password">
                                                    </div>
                                                    <div class="modal-footer"><button class="btn btn-danger"
                                                            type="button" data-dismiss="modal">إغلاق
                                                        </button><button class="btn btn-primary" type="submit"> موافق
                                                        </button></div>
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-secondary ml-1 mr-1" role="button"
                                    href="{{route('labos.edit',$labo->id)}}">
                                    تعديل</a>
                                <form method="POST" class="delete">
                                    @csrf

                                    <button class="btn btn-danger" type="submit">حذف</button>
                                </form>
                                <input type="hidden" class="deleteVal" value="{{$labo->id}} ">

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>




    <script type="text/javascript">
        $(document).ready(function () {
            $('.delete').submit(function (e) {
                e.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var delete_id = $(this).closest('.justify-content-center').find('.deleteVal').val();
                // alert (delete_id);

                Swal.fire({
                        title: 'هل تريد حذف هذا المخبر ؟؟',
                        text: "لن تستطيع استرجاع البيانات بعد هذه العملية",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        showCancelButton: true,
                        confirmButtonText: '!نعم، اريد الحذف',
                        cancelButtonText: ' اغلاق'
                    })
                    .then((result) => {

                        if (result.isConfirmed) {


                            var data = {
                                "id": delete_id,

                            }

                            $.ajax({
                                type: "DELETE",
                                url: '/labos/' + delete_id,
                                data: data,

                                success: function (response) {

                                    Swal.fire(response.status

                                        )

                                        .then((res) => {
                                            location.reload();
                                        });


                                }
                            });


                        }
                    });

            });
        });

    </script>

    <script type="text/javascript">
        $('#modal1').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var labo_id = button.data('laboid')
            var modal = $(this)
            modal.find('.modal-body #labos_id').val(labo_id);
            modal.find('.modal-body #show').attr('action', "/labos/" + labo_id);

        });

    </script>


    @endsection
