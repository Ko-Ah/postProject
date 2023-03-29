$(document).ready(function (){

    //Like
    var BtnLike = document.querySelectorAll('#like');
    for(var i=0; i< BtnLike.length;i++){
        if( BtnLike[i].getAttribute('data-status') == '1'){
            BtnLike[i].style.color='red';
        }


    }

    $('body').on('click','#like',function (){
        var id = $(this).data('id');
        var ModelClass = $(this).data('class');
        var Btn = document.querySelector(".post [data-id='" + id + "'] ");
        var status = Btn.getAttribute('data-status');

        let _token   = $('meta[name="csrf-token"]').attr('content');
        if(status == '0') {
            $.ajax({
                url: '/like',
                type: 'get',
                data: {
                    _token: _token,
                    likeable_type: ModelClass,
                    status: status,
                    id: id,
                },
                success: function (data) {
                    if (data.likes == '1') {
                        console.log('ok')
                        var Btn = document.querySelector(".post [data-id='" + id + "'] ");
                        var BtnI = document.querySelector(".post [data-id='" + id + "'] i");
                        Btn.setAttribute('data-status', '1');
                        BtnI.style.color = 'red';
                    }
                },
                error: function ($response) {
                }
            });
        }else if(status == '1'){
            $.ajax({
                url: '/unlike',
                type: 'get',
                data: {
                    _token: _token,
                    likeable_type: ModelClass,
                    status: status,
                    id: id,
                },
                success: function (data) {
                    console.log(data.likes)
                    if (data.likes == '0') {
                        console.log('ok')
                        var Btn = document.querySelector(".post [data-id='" + id + "'] ");
                        var BtnI = document.querySelector(".post [data-id='" + id + "'] i");

                        Btn.setAttribute('data-status', '0');
                        BtnI.style.color = 'grey';
                    }
                },
                error: function ($response) {
                }
            });
        }
    })

    //show more comments
    $("[data-content]").hide();
    $("body").on("click", '[data-read]' ,function () {
        var id = $(this).data('read');
        var txt = $("[data-content='" + id + "']").is(':visible') ? 'مشاهده نظرات' : 'بستن نظرات';
        $("[data-read='" + id + "']").text(txt);
        $(this).next("[data-content='" + id + "']").slideToggle(200);
    });

    //commments
    $('body').on('click','#commentBtn',function (){
        var postId= $(this).data('post');
        console.log(postId)
        $('#PostId').val(postId)
    })
    $('body').on('click','#addComment',function (){

        var commentTitle = $('[name="title"]').val();
        var commentTxt = $('[name="message"]').val();
        var postId = $('#PostId').val();

        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/dashboard/posts-comments',
            type: 'get',
            data: {
                _token: _token,
                body:commentTxt,
                commentTitle:commentTitle,
                postId:postId,
                parentId:0,
            },
            success: function (data) {

                $('#commentError').text(data.errors)

                if(data.data) {
                    if($('#commentSection'+data.data.post_id+'').find('#MoreLess').length == 0){
                        $('#commentSection'+data.data.post_id+'').prepend("<a id='MoreLess' data-read='"+data.data.post_id+"' style='font-size: medium;'>مشاهده نظرات</a>")
                    }
                    $('#commentError').text('')
                    $('[name="title"]').val('');
                    $('[name="message"]').val('');
                    //  $('#PostId').val('');
                    $('tbody [data-content="'+data.data.post_id+'"] [data-commentlist="'+data.data.post_id+'"]').prepend("<li data-column='"+data.data.id+"' style='display: flex;flex-direction: column' ><div style='display: flex;flex-direction:row'><img style='width: 30px;height: 30px; border-radius: 30px 30px;' src='https://eitrawmaterials.eu/wp-content/uploads/2016/09/person-icon.png' alt='person'><div><span>"+data.data.user.name+"</span><h5>"+data.data.title+"</h5><p>"+data.data.body+"</p></div></div><a data-reply='"+data.data.id+"' data-postid ='"+data.data.post_id+"' class='close' data-dismiss='modal' data-toggle='modal' data-target='#modal_reply' style='align-self: end;font-size: 16px'>پاسخ</a><ul data-replyitem='"+data.data.id+"'></ul></li>")
                }

            },
            error: function ($response) {
            }
        });
    })

    //reply ajax
    $('body').on('click','[data-reply]',function (){
        var postId= $(this).data('postid');
        console.log(postId)
        var commentId= $(this).data('reply');
        console.log(commentId)
        $('#commentId').val(commentId)
        $('#replyPostId').val(postId)
    })

    $('body').on('click','#addReply',function (){

        var replyTitle = $('[name="replyTitle"]').val();
        var replyTxt = $('[name="replyMessage"]').val();
        var postId = $('#replyPostId').val();
        var commentId = $('#commentId').val();
        console.log(replyTxt +" " +replyTitle +" "+postId +" "+ commentId)

        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/dashboard/posts-comments',
            type: 'get',
            data: {
                _token: _token,
                body:replyTxt,
                commentTitle:replyTitle,
                postId:postId,
                parentId:commentId,
            },
            success: function (data) {

                $('#replyError').text(data.errors)
                console.log(data.data)
                $('#replyError').text('')
                //  $('#commentId').val("");
                // $('#replyPostId').val('');
                $('[name="replyTitle"]').val('');
                $('[name="replyMessage"]').val('');
                $('[data-replyitem="'+data.data.reply.parent_id+'"]').append("<li><div  style='display: flex;flex-direction:row; padding-right:25px '><img style='width: 30px;height: 30px; border-radius: 30px 30px;' src='https://eitrawmaterials.eu/wp-content/uploads/2016/09/person-icon.png' alt=''><div><span>"+data.data.user.name+"</span><h5>"+data.data.reply.title+"</h5><p>"+data.data.reply.body+"</p></div></li>")

            },
            error: function ($response) {
            }
        });
    })


    $('body').on("click", "tbody tr .delete", function () {
        var id = $(this).data('id');

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
                        url: `/dashboard/posts-delete`,
                        data: {_token: _token, id: id}
                    }).done(function (data) {
                        $("[data-column="+id+"]").remove();
                        $("[data-comment="+id+"]").remove();
                        Swal.fire({
                            title: 'success',
                            text:  'حذف با موفقیت انجام شد',
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        })
                    }).fail(function () {
                        console.log('Ajax Failed')
                    });
                    // table4.row($(this).parents('tr')).remove().draw();
                }
            });

    })

    //Initialize the ckeditor
    ClassicEditor.create(document.querySelector("#ckeditor"), {
        extraPlugins: [SimpleUploadAdapterPlugin],
    }).catch((error) => {
        console.error(error);
    });
})
