$(document).ready(function () {
  const regDate =
    /^1[34][0-9][0-9]\/(0?[1-9]|1[012])\/(0?[1-9]|[12][0-9]|3[01])$/;
  const regSpecial = /[ `!@#$ %^&*()_+\-=\[\]{};':"\\|,.<>\/? ~]/;
  const regNumber = /^([^0-9]*)$/;
  const regSpace = /\s{2,}/g;

  $(".form-questions").on("submit", function (event) {
    const titlePlan = $(this).find('input[name="project_name"]');
    const nickName = $(this).find('input[name="name"]');
    const file = $(this).find("input[name=file]");

    if (titlePlan != undefined) {
      if (titlePlan.val() == "") {
        event.preventDefault();
        titlePlan.next(".errors").text("* فیلد عنوان نمی تواند خالی باشد!");
        titlePlan.addClass("field-error");
      } else if (
        regSpecial.test(titlePlan.val()) ||
        !regNumber.test(titlePlan.val()) ||
        regSpace.test(titlePlan.val())
      ) {
        event.preventDefault();
        titlePlan.next(".errors").text("* عنوان وارد شده معتبر نیست!");
        titlePlan.addClass("field-error");
      } else {
        titlePlan.next(".errors").text("");
        titlePlan.removeClass("field-error");
      }
    }

    if (nickName != undefined) {
      if (nickName.val() == "") {
        event.preventDefault();
        nickName
          .next(".errors")
          .text("* فیلد نام اختصاری نمی تواند خالی باشد!");
        nickName.addClass("field-error");
      } else if (
        regSpecial.test(nickName.val()) ||
        !regNumber.test(nickName.val()) ||
        regSpace.test(nickName.val())
      ) {
        event.preventDefault();
        nickName.next(".errors").text("* نام اختصاری وارد شده معتبر نیست!");
        nickName.addClass("field-error");
      } else {
        nickName.next(".errors").text("");
        nickName.removeClass("field-error");
      }
    }

    if (file != undefined) {
      if (file.val() == "") {
        event.preventDefault();
        $(".upload-main-wrapper")
          .find(".errors")
          .text("* این فیلد نمیتواند خالی باشد!");
        file.addClass("field-error");
      } else {
        $(".upload-main-wrapper").find(".errors").text("");
        file.removeClass("field-error");
      }
    }

    $(`.form-questions .calc-type input[type=number]`).each((index, item) => {
      if (item.value == "") {
        event.preventDefault();
        $(item).next(".errors").text("* این فیلد نمیتواند خالی باشد!");
        $(item).addClass("field-error");
        // } else if (parseFloat(item.value) < 0) {
        //   $(item)
        //     .next(".errors")
        //     .text("* مقدار این فیلد نمیتواند کمتر از 0 باشد!");
      } else {
        $(item).next(".errors").text("");
        $(item).removeClass("field-error");
      }
    });

    $(`.form-questions .date-inputs input:not(:disabled)`).each(
      (index, item) => {
        if (item.value == "") {
          event.preventDefault();
          $(item)
            .parent("div")
            .parent(".date-inputs")
            .find(".errors")
            .text("* فیلد تاریخ نمیتواند خالی باشد!");
          $(item).addClass("field-error");
        } else if (!regDate.test(item.value)) {
          event.preventDefault();
          $(item)
            .parent("div")
            .parent(".date-inputs")
            .find(".errors")
            .text("* تاریخ وارد شده معتبر نیست!");
          $(item).addClass("field-error");
        } else {
          $(item).parent("div").parent(".date-inputs").find(".errors").text("");
          $(item).removeClass("field-error");
        }
      }
    );
  });
});
