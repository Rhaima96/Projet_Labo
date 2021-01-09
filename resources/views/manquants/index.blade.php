@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col text-center" style="background: #f2cc5d;padding-bottom: 13px;padding-top: 6px;">
            <h1>وثيقة المعدات الناقصة<br></h1>
        </div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-end"><a class="btn btn-primary btn-lg" role="button"
                style="background: #966525;border-radius: 23px;margin-top: 10px;margin-bottom: 13px;"
                href="{{route('manques.create',  ['mat_id'=>$mat])}} ">إضافة</a></div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive table-bordered">
                <table class="table table-bordered table-hover table-dark">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="5"><strong>المعدات&nbsp;الناقصة</strong><br></th>
                        </tr>
                        <tr>
                            <th class="text-center" style="width: 200px;"><strong>الاعدادات</strong><br></th>
                            <th class="text-center"><strong>المسؤول</strong><br></th>
                            <th class="text-center"><strong>الكمية</strong><br></th>
                            <th class="text-center"><strong>نوع المعدات&nbsp;الناقصة</strong><br></th>
                            <th class="text-center"><strong>التاريخ</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr></tr>

                        @foreach ($mqs as $mq)
                        <tr>
                            <td class="d-flex justify-content-center" style="padding-left: 1px;width: 200px;">

                                <form method="POST" class="delete">
                                    @csrf

                                    <button class="btn btn-danger" type="submit" style="margin-left: 9px;"><i
                                        class="fa fa-trash" style="font-size: 24px;"></i></button>
                                </form>
                                <input type="hidden" class="deleteVal" value="{{$mq->id}} ">



                                <a class="btn btn-warning" role="button" href="{{route('manques.edit', $mq->id)}}" style="margin-left: 9px;margin-right: 9px;"><i
                                        class="fa fa-edit" style="font-size: 24px;"></i></a></td>


                            <td class="text-center">{{$mq->resp}} </td>
                            <td class="text-center">{{$mq->qte}} {{$mq->unite}} </td>
                            <td class="text-center">{{$mq->m_manquant}} </td>
                            <td class="text-center">{{$mq->date}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

            var delete_id = $(this).closest('tr').find('.deleteVal').val();
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
                            url: '/manques/' + delete_id,
                            data: data,

                            success: function (response) {

                                Swal.fire( response.status

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
