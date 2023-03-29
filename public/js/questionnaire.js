$(document).ready(function () {
  let state = 1;

  const steps = Array.from($(".steps .step"));

  function updateNavigation() {
    if (state == 1) {
      $(".nav-form .nav-prev").css("opacity", "0");
      $(".nav-form .nav-prev").css("visibility", "hidden");
    } else {
      $(".nav-form .nav-prev").css("visibility", "visible");
      $(".nav-form .nav-prev").css("opacity", "1");
    }

    if (state == 4) {
      $(".nav-form .nav-next").css("visibility", "hidden");
      $(".nav-form .nav-next").css("opacity", "0");
    } else {
      $(".nav-form .nav-next").css("visibility", "visible");
      $(".nav-form .nav-next").css("opacity", "1");
    }
  }

  updateNavigation();

  function updateProgress() {
    for (let x = 0; x < state; x++) {
      if (x == state - 1) {
        steps[state - 1].classList.add("current");
      } else {
        steps[x].classList.add("active");
        steps[x].querySelector(".step div").innerHTML =
          "<i class='fa-solid fa-check'></i>";
      }
    }

    for (let x = state; x < 4; x++) {
      steps[x].classList.remove("current");
      steps[x - 1].classList.remove("active");
      steps[x - 1].querySelector(".step div").innerHTML = x;
    }
  }
  updateProgress();

  function updateForms() {
    steps.forEach((step) => {
      if ($(`.questions-container #${step.dataset.step}`).attr("id") != state) {
        $(`.questions-container #${step.dataset.step}`).css("display", "none");
      } else {
        $(`.questions-container #${step.dataset.step}`).css("display", "block");
      }
    });
  }

  updateForms();

  function nextControl() {
    if (state < 4) {
      steps[state - 1].classList.add("current");
      state += 1;
      updateProgress();
      updateForms();
      updateNavigation();
    }
  }

  $(".nav-form .nav-prev").on("click", function () {
    if (state > 1) {
      steps[state - 1].classList.remove("current");
      state -= 1;
      updateProgress();
      updateForms();
      updateNavigation();
    }
  });


  // =========== validation ==========

  const regDate =
    /^1[34][0-9][0-9]\/(0?[1-9]|1[012])\/(0?[1-9]|[12][0-9]|3[01])$/;
  const regSpecial = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
  const regNumber = /^([^0-9]*)$/;
  const regSpace = /\s{2,}/;

  $(".nav-next").on("click", function (event) {
    const titlePlan = $(`.form-questions #${state}`).find(
      'input[name="project_name"]'
    );
    const nickName = $(`.form-questions #${state}`).find('input[name="name"]');
    const file = $(`.form-questions #${state}`).find("input[name=file]");

    if (titlePlan != undefined) {
      if (titlePlan.val() == "") {
        titlePlan.next(".errors").text("* فیلد عنوان نمی تواند خالی باشد!");
        titlePlan.addClass("field-error");
      } else if (
        regSpecial.test(titlePlan.val()) ||
        !regNumber.test(titlePlan.val()) ||
        regSpace.test(titlePlan.val())
      ) {
        titlePlan.next(".errors").text("* عنوان وارد شده معتبر نیست!");
        titlePlan.addClass("field-error");
      } else {
        titlePlan.next(".errors").text("");
        titlePlan.removeClass("field-error");
      }
    }

    if (nickName != undefined) {
      if (nickName.val() == "") {
        nickName
          .next(".errors")
          .text("* فیلد نام اختصاری نمی تواند خالی باشد!");
        nickName.addClass("field-error");
      } else if (
        regSpecial.test(nickName.val()) ||
        !regNumber.test(nickName.val()) ||
        regSpace.test(nickName.val())
      ) {
        nickName.next(".errors").text("* نام اختصاری وارد شده معتبر نیست!");
        nickName.addClass("field-error");
      } else {
        nickName.next(".errors").text("");
        nickName.removeClass("field-error");
      }
    }

    if (file != undefined) {
      if (file.val() == "") {
        $(".upload-main-wrapper")
          .find(".errors")
          .text("* این فیلد نمیتواند خالی باشد!");
        file.addClass("field-error");
      } else {
        $(".upload-main-wrapper").find(".errors").text("");
        file.removeClass("field-error");
      }
    }

    $(`.form-questions #${state} .calc-type input[type=number]`).each(
      (index, item) => {
        if (item.value == "") {
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
      }
    );

    $(`.form-questions #${state} .date-inputs input:not(:disabled)`).each(
      (index, item) => {
        if (item.value == "") {
          $(item)
            .parent("div")
            .parent(".date-inputs")
            .find(".errors")
            .text("* فیلد تاریخ نمیتواند خالی باشد!");
          $(item).addClass("field-error");
        } else if (!regDate.test(item.value)) {
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

    let nextFlag = $(`.form-questions #${state} .errors`).text() == "";

    if (nextFlag) {
      nextControl();
    }
  });
});
