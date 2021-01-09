@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col text-center" style="background: #f2cc5d;padding-bottom: 13px;padding-top: 6px;">
            <h1> المعدات</h1>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-end">
            <a class="btn btn-primary btn-lg" role="button"
                href="{{route('materiels.create', ['labo_id'=> $labo , 'l_password'=>$l_password])}} "
                style="background: #966525;border-radius: 23px;margin-top: 10px;margin-bottom: 13px;">إضافة</a>
        </div>

    </div>
    <div class="row">
        <div class="col">
            <div class="row row-cols-1 row-cols-md-3">
                @foreach ($mats as $mat)
                <div class="col mb-4">
                    <div class="card" style="background: rgb(242,204,93)">
                        <img src="{{asset('uploads/materials/' . $mat->photo)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="card-title text-center">{{$mat->title}}</h3>
                            <div class="d-flex justify-content-center mt-4"><a class="btn btn-primary" role="button"
                                    href="{{route('materiels.show', $mat->id)}}">تصفح<br></a>
                                <a class="btn btn-secondary ml-1 mr-1" role="button"
                                    href="{{route('materiels.edit',[$mat->id, 'l_password'=> $l_password])}}">
                                    تعديل  </a>
                                <form method="POST" class="delete">
                                    @csrf

                                    <button class="btn btn-danger" type="submit">حذف</button>
                                </form>
                                <input type="hidden" class="deleteVal" value="{{$mat->id}} ">

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
                        title: 'هل تريد حذف هذه المعدات ؟؟',
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
                                url: '/materiels/' + delete_id,
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

    @endsection
