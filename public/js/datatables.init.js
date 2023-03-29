$('.odd').hide()
    function fetch(data) {

        for (var i = 0; i < data['categories'].length; i++) {

                $('tbody').append("<tr style='width: 100%;' data-column='" + data['categories'][i]['id'] + "'><td class='table-img'><img src='images/p-13.jpg' alt></td><td id='name'>" + data['categories'][i]['name'] + "</td><td id='subName' data-subname='" + data['categories'][i]['id'] + "'></td><td><div style='margin: 1px 0'><a data-id='" + data['categories'][i]['id'] + "' class='btn btn-primary shadow btn-xs sharp ml-1 edit' id='edit'  data-id='" + data['categories'][i]['id'] + "' data-subname data-toggle='modal' data-target='#modal_update_adduser'><i class='fa fa-pencil'></i></a><a data-id='" + data['categories'][i]['id'] + "' data-subname class='btn btn-danger shadow btn-xs sharp delete show_confirm' data-toggle='tooltip' title='Delete'><i class='fa fa-trash'></i></a></div></td></tr>")
        }
            for (var i = 0; i < data['subCategories'].length; i++) {

                if(data['subCategories'][i]['cat_id']){
                    var num =data['subCategories'][i]['cat_id'];
                    var tdSubName = document.querySelector("[data-column='" + data['subCategories'][i]['cat_id'] + "'] td#subName")
                        tdSubName.innerText =data['subCategories'][i]['name'];
                            tdSubName.setAttribute('data-subname',data['subCategories'][i]['id'])
                    var BtnDelete = document.querySelector("[data-column='" + data['subCategories'][i]['cat_id'] + "'] .delete")
                    BtnDelete.setAttribute('data-subname',data['subCategories'][i]['id']);
                            var BtnEdit = document.querySelector("[data-column='" + data['subCategories'][i]['cat_id'] + "'] .edit")
                    BtnEdit.setAttribute('data-subname',data['subCategories'][i]['id']);
                }else{
                    $('.odd').hide();
                }

        }

    }
  //ajax fetch data
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url:'/dashboard/categories/ajax',
    type: 'get',
        data: {
        _token: _token,
    },
    success: function (data) {
        fetch(data.data);
    },
    error: function ($response) {
    }
});

  // category section
    const regSpecial = /[`@#$%^&*+=\[\]{}'"\\|<>\/~]/;

    $(".post-tags").on("keydown", function (event) {

        if (event.key == "Enter") {
            event.preventDefault();
            event.stopPropagation();

            addTags(event);
        }
    });

    $(".post-tags+i").on("click", addTags);

    $(".tag-item i").on("click", removeTag);

    function removeTag(event) {
        $(event.target).parent(".tag-item").remove();
    }

    function addTags(event) {
        if (
            $(".post-tags").val() == "" ||
            regSpecial.test($(".post-tags").val()) ||
            $(".post-tags").val().length > 255
        ) {
            event.preventDefault();
            $(".post-tags")
                .siblings(".errors")
                .text("* دسته وارد شده صحیح نمی باشد!");
        } else {
            $(".tags-container").append(
                `<a class="tag-item">
      <i class="fa-solid fa-xmark align-middle"></i>
      ${$(".post-tags").val()} <input type="hidden" name="tag[]" id="InputVal" value="  ${$(".post-tags").val()} "/>
  </a>`
            );


            $(".tag-item i").off("click", removeTag);

            $(".tag-item i").on("click", removeTag);

            $(".post-tags").val("");
            $(".post-tags").siblings(".errors").text("");

        }
    }
    // delete ajax
    $('body').on("click", "tbody tr .delete", function () {
        $('.project-list-header').html('');
        var id = $(this).data('id');
        var childId = $(this).data('subname');
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
                        url: `/dashboard/categories-delete`,
                        data: {_token: _token, id: id,childId:childId}
                    }).done(function (data) {

                         $('#categorySelect option[value='+id+']').remove();
                         $('#updateCategorySelect option[value='+id+']').remove();
                        $("[data-column="+id+"]").remove();


                        Swal.fire({
                            title: 'success',
                            text:  data.success,
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        })
                    }).fail(function () {
                        console.log('Ajax Failed')
                    });
                }
            });

    })

    //edit data
    $('body').on('click','.edit', function (event) {
        $('.project-list-header').html('');
        $('#updateCard').show();
        $('#ajaxCard').hide();
        var childId = $(this).data('subname');
        var id = $(this).data('id');
        $('#id').val(id);
        $('.updateFormDiv').show();
        for(var j=0; j<2;j++){
            $(".update-tag-item i").click();
        }
        let _token   = $('meta[name="csrf-token"]').attr('content');
        $.ajax
        ({
            type: "get",
            dataType: 'json',
            url: `/dashboard/categories-edit`,
            data: {_token: _token, id: id,childId:childId }
        }).done(function (data) {

                $("#updateCategorySelect").val(data['categories'].name);


            for(var i=0;i<data.subCat.length;i++){
                $(".update-tag-item i.update").click();
                $(".update-tags-container").append(
                    `<a class="update-tag-item"><i class="fa-solid fa-xmark align-middle update" style="top:45%"></i>${data.subCat[i].name} </a>`)
            }
        }).fail(function () {
            console.log('Ajax Failed')
        });
    });
  $('#updateCategoryVal').val('');
    $('body').on('click', '#updateButton', function (event) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
    });

    $('#closeBtnUpdate').click(function (event) {
        event.preventDefault();
        this.setAttribute('data-dismiss','modal');
        $('#updateError').html('');
        $('.project-list-header').html('');
        var InputVal = document.getElementsByName('tag[]');
        for (var j = 0; j < InputVal.length; j++) {
            $(".tag-item i").click();
        }
    });

    $( '#updateButton').click( function (event) {
        event.preventDefault();
        event.stopPropagation();
        var id = $('#id').val();
        $('.project-list-header').html('');
        $('#updateError').html('');
        var parentName = $("#updateCategorySelect").val();
        var childName = $('#updateCategoryVal').val();

        var BtnEdit = document.querySelector("[data-column='" + id + "'] .edit");
        var childId= BtnEdit.getAttribute('data-subname');
        var updateInputVal = document.getElementsByName('updateTag[]')
        for(var j=0; j<updateInputVal.length;j++){
            $(".update-tag-item i.update").click();
        }
        $("[data-column="+id+"]").val(id);
        let _token   = $('meta[name="csrf-token"]').attr('content');
        const regSpecial = /[`@#$%^&*+=\[\]{}'"\\|<>\/~]/;

        if (
            $("#updateCategorySelect").text() == "" ||
            regSpecial.test($("#updateCategorySelect").text()) ||
            $("#updateCategorySelect").text().length > 255
        ) {
            event.preventDefault();
            $(".catError")
                .text("* دسته وارد شده صحیح نمی باشد!");
        }else
            {
                $.ajax
                ({
                    type: "get",
                    dataType: 'json',
                    url: `/dashboard/categories-update`,
                    data: {_token: _token, id: id, parentName: parentName, childName: childName, childId: childId,}
                }).done(function (data) {

                    $("#updateCategorySelect").val('')
                    $('#updateCategoryVal').val('')
                    $(".updatename").val("");
                    $('#user-field').val('')

                    if (data.data['flag']) {

                        if (data.data.hasOwnProperty('parentCat')) {
                            $('#categorySelect option[value=' + data.data['parentCat']['id'] + ']').remove();
                            var tdName = document.querySelector("[data-column='" + id + "'] td#name");
                            tdName.innerText = data.data['parentCat']['name'];
                            $('#categorySelect').append("<option value='" + data.data['parentCat']['id'] + "'>" + data.data['parentCat']['name'] + "</option>");
                        }
                        if (data.data.hasOwnProperty('childCat')) {
                            var tdName = document.querySelector("[data-column='" + id + "'] td#subName");
                            tdName.innerText = data.data['childCat']['name'];
                        }
                        $('.updateFormDiv').hide();
                        Swal.fire({
                            title: 'success!',
                            text: data.success,
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        })
                        $('.project-list-header').html('<h4 style="color: green">آیتم باموفقیت آپدیت شد</h4>');
                    } else {
                        $('#updateError').html('<h4 style="color: red">'+data.errors+'</h4>');
                    }
                }).fail(function (data) {
                    Swal.fire({
                        title: 'error!',
                        text: 'Request failed',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    })

                });
            }
    });

  //update section

  $(".update-post-tags").on("keydown", function (event) {
      if (event.key == "Enter") {
          event.preventDefault();
          event.stopPropagation();
          addUpdateTags(event);
      }
  });

  $(".update-post-tags+i.update").on("click", addUpdateTags);

  $(".update-tag-item i.update").on("click", removeUpdateTag);

  function removeUpdateTag(event) {
      $(".update-tags-container").append(
          ` <input type="hidden" name="removetag[]" id="removeTag" value="  ${$(event.target).parent(".update-tag-item").text()} "/>`)
      $(event.target).parent(".update-tag-item").remove();
  }

  function addUpdateTags(event) {
      if (
          $(".update-post-tags").val() == "" ||
          regSpecial.test($(".update-post-tags").val()) ||
          $(".update-post-tags").val().length > 255
      ) {
          event.preventDefault();
          $(".update-post-tags")
              .siblings(".errors")
              .text("* دسته وارد شده صحیح نمی باشد!");
      } else {
          $(".update-tags-container").append(
              `<a class="update-tag-item">
      <i class="fa-solid fa-xmark align-middle update" style="top:45%"></i>
      ${$(".update-post-tags").val()} <input type="hidden" name="updateTag[]" id="UpdateInputVal" value="  ${$(".update-post-tags").val()} "/>
  </a>`
          );

          $(".update-tag-item i.update").off("click", removeUpdateTag);

          $(".update-tag-item i.update").on("click", removeUpdateTag);

          $(".update-post-tags").val("");
          $(".update-post-tags").siblings(".errors").text("");

          var updateInputVal = document.getElementsByName('updateTag[]');
          var updateinputVal = ''
          var arr = [];
          for (var i = 0; i < updateInputVal.length; i++) {
              var updatecontent = updateInputVal[i].value;
              console.log(updatecontent)
              updateinputVal = updatecontent.trim();
              arr.push(updateinputVal);
              $('#updateCategoryVal').val('')
              $('#updateCategoryVal').val(arr);
              console.log($('#updateCategoryVal').val())
          }

      }
  }
    //fetch category data

        function filterCat(data) {

            for (var i = 0; i < data['categories'].length; i++) {
                $('#categorySelect').append("<option value='" + data['categories'][i]['id'] + "'>" + data['categories'][i]['name'] + "</option>");
            }
        }
        $.ajax({
            url: "/dashboard/categories/Category",
            type: 'get',
            data: {
                _token: _token,
            },
            success: function (data) {

                filterCat(data.data);
            },
            error: function ($response) {
            }
        });

    // update select ajax fetch
    function filterCategory(data) {

        for (var i = 0; i < data['categories'].length; i++) {
            $('#updateCategorySelect').append("<option value='" + data['categories'][i]['id'] + "'>" + data['categories'][i]['name'] + "</option>");
        }
    }

    $.ajax({
        url: "/dashboard/categories/Category",
        type: 'get',
        data: {
            _token: _token,
        },
        success: function (data) {

            filterCategory(data.data);
        },
        error: function ($response) {
        }
    });
    $('#closeBtnAjax').click(function (event) {
        event.preventDefault();
        this.setAttribute('data-dismiss','modal');
        var InputVal = document.getElementsByName('tag[]');
        for (var j = 0; j < InputVal.length; j++) {
            $(".tag-item i").click();
        }
    });

    $('#addButton').click(function (){
        $('.project-list-header').html('');
        $('#addError').html('');
    })
    $('#ajaxAddButton').click(function (event) {
        $('.project-list-header').html('');
        $('#addError').html('');
        let _token = $('meta[name="csrf-token"]').attr('content');

         event.preventDefault();
        event.stopPropagation();
        this.setAttribute('data-dismiss','modal');
         event.stopImmediatePropagation();
        var InputVal = document.getElementsByName('tag[]');
        var inputVal = ''
        var arr = [];
        for (var i = 0; i < InputVal.length; i++) {
            var content = InputVal[i].value;
            console.log(content)
            inputVal = content.trim();
            arr.push(inputVal);
            $('#categoryVal').val('')
            $('#categoryVal').val(arr);
            console.log($('#categoryVal').val())
        }

        $("#name-error").text("* مقدار وارد شده صحیح نمی باشد!");
        $.ajax({
            url: "/dashboard/categories/add",
            type: 'get',
            data: {
                parentId: $('#categorySelect').val(),
                name: $('#categoryVal').val(),
                _token: _token
            }
        }).done(function (data) {
            for (var j = 0; j < InputVal.length; j++) {
                $(".tag-item i").click();
            }
            $('#categorySelect').val('');
            $('#categoryVal').val('')
            $('#user-field').val('');

if(data.data['flag']) {
    if (data.arr) {
        for(var i=0;i< data.arr.length;i++) {
            $('#categorySelect').append("<option value='" + data.arr[i].id + "'>" + data.arr[i].name + "</option>");

            $('tbody').append("<tr style='width: 100%;' data-column='" + data.arr[i].id + "'><td class='table-img'><img src='images/p-13.jpg' alt></td><td id='name'>" + data.arr[i].name + "</td><td id='subName'></td><td><div><a data-id='" + data.arr[i].id + "' class='btn btn-primary shadow btn-xs sharp ml-1 edit' id='edit'  data-toggle='modal' data-target='#modal_update_adduser'><i class='fa fa-pencil'></i></a><a data-id='" + data.arr[i].id + "' class='btn btn-danger shadow btn-xs sharp delete show_confirm' data-toggle='tooltip' title='Delete'><i class='fa fa-trash'></i></a></div></td></tr>")
        }

    }

    if(data.arrChild){

        var tdSubName = document.querySelector("[data-column='" + data.arrChild[0].cat_id + "'] td#subName");
        console.log(tdSubName)
        tdSubName.innerText = data.arrChild[0].name;
    }
    $('.project-list-header').html('<h4 style="color: green">آیتم باموفقیت ثبت شد</h4>');
}else{
    $('#addError').html('<h4 style="color: red">'+data.errors+'</h4>');
}
            $('.alert').show();
            $('.alert').html(data.success);
            $('#addName').val("");
            $('#addEmail').val("");
            $('#addPassword').val("");
        }).fail(function (error) {
            $('.errors').html('');

        });
    })


