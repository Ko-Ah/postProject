@extends('dashboard.layouts.master')

@section('content')
    <div class="col-12" style="width: 1000px;background: white;margin-right: 140px;padding:30px;margin-top: 100px;">
        <div class="project-list-header">
            <h2 class="text-center border-bottom py-2 pt-4 mb-3">
                لیست تگ ها
            </h2>
        </div>

        <div class="user-list">
            <button href="#" type="button" class="add-user" data-toggle="modal" data-target="#modal_adduser" id="addButton">
                <i class="fa-solid fa-plus align-middle"></i>
                ایجاد تگ جدید
            </button>
            <div class="table-responsive">
                <table id="table_id3" class="display" style="min-width: 845px;">
                    <thead>
                    <tr>
                        <th style="text-align: center">#</th>
                        <th style="text-align: center">نام</th>
                        <th style="text-align: center">اقدام</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_adduser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">ایجاد تگ</h4>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form_adduser">
                            <div class="form-group">
                                <label class="mb-1"><strong>نام</strong></label>
                                <input type="text" class="form-control px-5 addName"  id="user-field" name="name"
                                       value="{{old('name')}}" >
                                <div id="name-error" class=" text-danger fs-6">

                                </div>
                            </div>
                            <div id="addError"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closeBtnAjax" class="btn btn-danger light" data-dismiss="modal">بستن</button>
                        <button type="button"  id="ajaxAddButton" data-dismiss="modal" class="btn btn-primary">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_update_adduser">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">آپدیت</h4>
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                        </button>
                    </div>
                    <input type="hidden" id="id" >
                    <div class="modal-body">
                        <div class="form_adduser">
                            <div class="form-group">
                                <label class="mb-1"><strong>نام</strong></label>
                                <input type="text" class="form-control px-5 updatename"  id="user-field" name="name"
                                       value="{{old('name')}}" >
                                <div id="user-error" class=" text-danger fs-6">

                                </div>
                            </div>
                            <div id="updateError"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"  class="btn btn-danger light" id="closeBtnUpdate" data-dismiss="modal">بستن</button>
                        <button type="button"  id="updateButton" data-dismiss="modal" class="btn btn-primary">ارسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{asset('js/global.min.js')}}"></script>
    <script src="{{asset('js/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('js/custom.min.js')}}"></script>
    <script src="{{asset('js/deznav-init.js')}}"></script>
    <script src="{{asset('js/apexchart.js')}}"></script>
    <script src="{{asset('js/jquery.peity.min.js')}}"></script>
    <script src="{{asset('js/chartist.min.js')}}"></script>
    <script src="{{asset('js/dashboard-1.js')}}"></script>
    <script src="{{asset('js/vivus.min.js')}}"></script>
    <script src="{{asset('js/svg.animation.js')}}"></script>
    <script src="{{asset('js/dataTables.js')}}"></script>
    <script src="{{asset('js/tag.js')}}"></script>
    <script src="{{asset('js/custom-select.js')}}"></script>
    <script src="{{asset('js/darkmode-init.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>



    <script>

                //edit
                $('body').on('click','.edit', function () {
                    $('#updateCard').show();
                    $('#ajaxCard').hide();

                    var id = $(this).data('id');
                    $('#id').val(id);
                    $('.updateFormDiv').show();
                    let _token   = $('meta[name="csrf-token"]').attr('content');
                    var updateTxt= $(this).parent().parent();
                    var tdChild= updateTxt.children();
                    for(var i=0;i<tdChild.length;i++){
                        tdChild[1].className = "Text"+id+"";
                    }
                    $.ajax
                    ({
                        type: "get",
                        dataType: 'json',
                        url: `/dashboard/tags-edit`,
                        data: {_token: _token, id: id }
                    }).done(function (data) {
                        for(tag in data){

                            $(".updatename").val(data[tag].name);
                        }
                    }).fail(function () {
                        console.log('Ajax Failed')
                    });
                });

            $('body').on('click', '#updateButton', function (e) {
               var id = $('#id').val();
                $('.project-list-header').html('');
               var name =$(".updatename").val();
               $("[data-column="+id+"]").val(id);
               e.preventDefault();
               let _token   = $('meta[name="csrf-token"]').attr('content');
                const regSpecial = /[`@#$%^&*+=\[\]{}'"\\|<>\/~]/;
                if (
                    $('.updatename').val() == "" ||
                    regSpecial.test($(".updatename").val()) ||
                    $(".updatename").val().length > 255 || !isNaN($(".updatename").val())
                ) {
                    event.preventDefault();
                    $("#user-error").text("* مقدار وارد شده صحیح نمی باشد!");
                }else {
                    $.ajax
                    ({
                        type: "get",
                        dataType: 'json',
                        url: `/dashboard/tags-update`,
                        data: {_token: _token, id: id, name: name}
                    }).done(function (data) {
                        $(".updatename").val("");
                        Swal.fire({
                            title: 'success!',
                            text: data.success,
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        })
                        if(data.data['flag']) {
                        var Text = document.querySelector('.Text'+id+'');
                        Text.innerText=data.data['tags']['name'];
                        var tdName = document.querySelector("[data-column='" + id + "'] td#name");
                        tdName.innerText = data.data['tags']['name'];
                        $('.updateFormDiv').hide();

                        }else{
                            $('.project-list-header').html('<h4 style="color: red">آیتم قبلا وارد شده است</h4>');
                        }
                    }).fail(function () {
                        Swal.fire({
                            title: 'error!',
                            text: 'Request failed',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })
                    });
                }
           });
    </script>
@endpush

