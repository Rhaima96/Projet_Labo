@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col text-center" style="background: #f2cc5d;padding-bottom: 13px;padding-top: 6px;">
            <h1>بطاقة وصول<br></h1>
        </div>
    </div>
    <div class="row">
        <div class="col">


                <a class="btn btn-primary btn-sm" role="button"  href="{{route('pannes.index',  ['mat_id'=>$mat['id']])}} "
                style="background: #966525;border-radius: 23px;margin-top: 10px;margin-bottom: 13px;">المعدات
                المعطبة</a>


                <a class="btn btn-primary btn-sm" role="button"  href="{{route('detruits.index',  ['mat_id'=>$mat['id']])}} "
                style="background: #966525;border-radius: 23px;margin-top: 10px;margin-bottom: 13px;margin-left: 15px;">المعدات
                المتلفة</a>

                <a class="btn btn-primary btn-sm" role="button"
                style="background: #966525;border-radius: 23px;margin-top: 10px;margin-bottom: 13px;margin-left: 15px;" href="{{route('manques.index',  ['mat_id'=>$mat['id']])}} ">المعدات
                الناقصة</a>

            </div>


        <div class="col d-flex justify-content-end"><a class="btn btn-primary btn-lg" role="button"
                href="{{route('arrives.create',  ['mat_id'=>$mat['id']])}} "
                style="background: #966525;border-radius: 23px;margin-top: 10px;margin-bottom: 13px;">إضافة</a></div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mt-5 mt-md-0 search-area" style="margin-bottom: 17px;"><i
                    class="fas fa-search float-left search-icon"></i><input id="search"
                    class="float-left float-sm-right custom-search-input" type="search"
                    placeholder="Recherche par référence" name="search"></div>
            <div class="table-responsive table-bordered">
                <table class="table table-bordered table-hover table-dark" >
                    <thead>
                        <tr>
                            <th class="text-center" colspan="8"><strong>Fiche d'arrivage de matériel </strong>
                            </th>
                        </tr>
                        <tr>
                            <th>N/D</th>
                            <th>REF</th>
                            <th>DESIGNATION</th>
                            <th>DATE</th>
                            <th>QTE</th>
                            <th>N/IV</th>
                            <th>N/BS</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table">
                        <tr></tr>

                        @php
                        $i = 1
                        @endphp
                        @foreach ($arrs as $arr)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$arr->ref}}</td>
                            <td>{{$arr->designation}}</td>
                            <td>{{$arr->date->format('d-m-Y')}}</td>
                            <td>{{$arr->qte}} {{$arr->unite}} </td>
                            <td>{{$arr->nv}}</td>
                            <td>{{$arr->nbs}}</td>

                            <td class="d-flex">
                                <a class="btn btn-primary" role="button" href="{{route('arrives.show', $arr->id)}}" ><i class="fa fa-eye"
                                        style="font-size: 24px;"></i></a>

                                        <a class="btn btn-warning" role="button"
                                    style="margin-left: 9px;" href="{{route('arrives.edit', $arr->id)}}"><i class="fa fa-edit" style="font-size: 24px;"></i></a>



                                        <form method="POST" class="delete">
                                            @csrf

                                            <button class="btn btn-danger" type="submit" style="margin-left: 9px;"><i
                                                class="fa fa-trash" style="font-size: 24px;"></i></button>
                                        </form>
                                        <input type="hidden" class="deleteVal" value="{{$arr->id}} ">

                            </td>
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
                            url: '/arrives/' + delete_id,
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


<script>
    $(document).ready(function(){
      $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
    </script>


@endsection
