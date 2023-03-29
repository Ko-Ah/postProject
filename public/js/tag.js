(function ($) {
    "use strict";
var table3 = $("#table_id3").DataTable({
    "ajax": {
        "url": "/dashboard/tags/ajax",
        "type": "GET"
    },
    "columns": [
        {"defaultContent": ""},
        {"data": "name","defaultContent": ""},
        {
            render: function (data, type, full) {
                return "<a class='btn btn-primary shadow btn-xs sharp ml-1 edit' data-id='" + full['id'] + "' id='edit' data-toggle='modal' data-target='#modal_update_adduser'><i class='fa fa-pencil'></i></a><a class='btn btn-danger shadow btn-xs sharp delete show_confirm' data-toggle='model' data-target='#infoModel'  data-id='" + full['id'] + "' data-toggle='tooltip' title='Delete'><i class='fa fa-trash'></i></a>";
            }
        },
    ],
    createdRow: function (row, data, index) {
        $(row).addClass("selected");
    },
});
    //delete data
    table3.on("click", "tbody tr .delete", function () {
        var id = $(this).data('id');
        var elem=   $(this).parent().parent();
        elem.addClass('Text'+id+'');
        let _token   = $('meta[name="csrf-token"]').attr('content');
        swal({
            title: `برای حذف آیتم مطمئن هستید؟`,
            text: "در صورت حذف امکان بازگشت دیتا وجود ندارد",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax
                    ({
                        type: "get",
                        dataType: 'json',
                        url: `/dashboard/tags-delete`,
                        data: {_token: _token, id: id}
                    }).done(function (data) {
                        Swal.fire({
                            title: 'success',
                            text:  data.success,
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        })
                    }).fail(function () {
                        console.log('Ajax Failed')
                    });
                    table3.row($(this).parents('tr')).remove().draw();
                }
            });
    });

    let _token   = $('meta[name="csrf-token"]').attr('content');

    $('#closeBtnAjax').click(function (event) {
        event.preventDefault();
        this.setAttribute('data-dismiss','modal');
    });
    $('#addButton').click(function (){
        $('.project-list-header').html('');
        $('#addError').html('');
    })
    //add data
    $('#ajaxAddButton').click(function (event) {
        $('.project-list-header').html('');
        $('#addError').html('');
        $('.addModel').hide();
        event.preventDefault();
        event.preventDefault();
        event.stopPropagation();
        this.setAttribute('data-dismiss','modal');
        const regSpecial = /[`@#$%^&*+=\[\]{}'"\\|<>\/~]/;
        if (
            $('.addName').val() == "" ||
            regSpecial.test($(".addName").val()) ||
            $(".addName").val().length > 255 || !isNaN($(".addName").val())
        ) {

            $("#name-error").text("* مقدار وارد شده صحیح نمی باشد!");
        }else {

            $.ajax({
                url: "/dashboard/tags/add",
                type: 'get',
                data: {
                    name: $('#user-field').val(),
                    _token: _token
                },
                success: function (data) {

                    $('#user-field').val('')
                    console.log(data)
                if(data.data['flag']) {
                    var td = table3.row.add([]).draw();
                    var tdColumn = td.nodes().to$().children();
                    var tdColBtn = td.nodes().to$();
                    var btn = tdColumn[2].children;
                    tdColumn.children('a:nth-child(1)').attr('data-id', data.data['tags']['id']);
                    tdColumn.children('a:nth-child(2)').attr('data-id', data.data['tags']['id']);
                    tdColumn[1].className = "Text" + data.data['tags']['id'] + "";
                    tdColumn[1].innerText = data.data['tags']['name'];
                    $('.project-list-header').html('<h4 style="color: green">آیتم باموفقیت ثبت شد</h4>');
                }else {
                    $('#addError').html('<h4 style="color: red">'+data.errors+'</h4>');
                }


                    /*   $('tbody').append("<tr data-column='" + data.data['tags']['id'] + "'><td class='table-img'><img src='images/p-13.jpg' alt></td><td id='name'>" + data.data['tags']['name'] + "</td><td><div class='d-flex' style='    flex-direction: row-reverse;'><a data-id='" + data.data['tags']['id'] + "' class='btn btn-primary shadow btn-xs sharp ml-1 edit' id='edit'  data-toggle='modal' data-target='#modal_update_adduser'><i class='fa fa-pencil'></i></a><a data-id='" + data.data['tags']['id'] + "' class='btn btn-danger shadow btn-xs sharp delete show_confirm' data-toggle='tooltip' title='Delete'><i class='fa fa-trash'></i></a></div></td></td></tr>")*/

                    $('.alert').show();
                    $('.alert').html(data.success);
                    $('#addName').val("");
                    $('#addEmail').val("");
                    $('#addPassword').val("");
                },
                error: function (error) {
                    $('#name-error').html('error');
                }
            });
        }
    });
    table3.on("click", "tbody tr", function () {
        var $row = table3.row(this).nodes().to$();
        var hasClass = $row.hasClass("selected");
        if (hasClass) {
            $row.removeClass("selected");
        } else {
            $row.addClass("selected");
        }
    });
    table3.rows().every(function () {
        this.nodes().to$().removeClass("selected");
    });
})(jQuery);
