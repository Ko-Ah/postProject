$(document).ready(function () {
  const type1 = `<div class="calc-type" id="type1">
    <div>
        <div class="type-title">
            <h4 class="pb-2 step-title"><span></span>مقایسه میانگین دو جامعه</h4>
            <img src="/images/icons8-formula-100.png" class="open-formula" />
            <div class="formula-img">
                <span class="close-img">
                    <i class="fa-solid fa-xmark"></i>
                </span>
                <div>
                    <h3 class="text-white text-center mb-4">محاسبه میانگین دو جامعه
                    </h3>
                    <img src="/images/method-1.jpg" class="w-100" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
                <label><strong>سطح اطمینان (α)</strong></label>
                <input type="number" name="confidence_level" class="form-control"
                    placeholder="مقدار پیش فرض : 0.05" />
                    <div class="errors text-danger fs-6"></div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
                <label><strong>توان آزمون (ϭ - 1)</strong></label>
                <input type="number" name="test_power" class="form-control"
                    placeholder="مقدار پیش فرض : 0.9" />
                    <div class="errors text-danger fs-6"></div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
                <label><strong>انحراف معیار جامعه اول (σ1)</strong></label>
                <input type="number" name="standard_deviation_first" class="form-control"
                    placeholder="مقدار پیش فرض : 1" />
                    <div class="errors text-danger fs-6"></div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
                <label><strong>انحراف معیار جامعه دوم (σ2)</strong></label>
                <input type="number"  name="standard_deviation_second" class="form-control"
                    placeholder="مقدار پیش فرض : 1" />
                    <div class="errors text-danger fs-6"></div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
                <label><strong>میانگین جامعه اول (µ1)</strong></label>
                <input type="number" name="average_community_first" class="form-control"
                    placeholder="مقدار پیش فرض : 0" />
                    <div class="errors text-danger fs-6"></div>
            </div>
            <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
                <label><strong>میانگین جامعه دوم (µ2)</strong></label>
                <input type="number" name="average_community_second" class="form-control"
                    placeholder="مقدار پیش فرض : 1" />
                    <div class="errors text-danger fs-6"></div>
            </div>
        </div>
    </div>
</div>`;

  const type2 = `<div class="calc-type" id="type2">
<div>
    <div class="type-title">
        <h4 class="pb-2 step-title"><span></span>مقایسه شیوع دو جامعه</h4>
        <img src="images/icons8-formula-100.png" class="open-formula" />
        <div class="formula-img">
            <span class="close-img">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <div>
                <h3 class="text-white text-center mb-4">محاسبه شیوع دو جامعه
                </h3>
                <img src="images/method-2.jpg" class="w-100" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>سطح اطمینان (α)</strong></label>
            <input type="number" name="confidence_level" class="form-control"
                placeholder="مقدار پیش فرض : 0.05" />
                <div class="errors text-danger fs-6"></div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>توان آزمون (ϭ - 1)</strong></label>
            <input type="number" name="test_power" class="form-control"
                placeholder="مقدار پیش فرض : 0.9" />
                <div class="errors text-danger fs-6"></div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong> شیوع جامعه اول (p1)</strong></label>
            <input type="number" name="Prevalence_community_first" class="form-control"
                placeholder="مقدار پیش فرض : 0.5" />
                <div class="errors text-danger fs-6"></div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong> شیوع جامعه اول (p2)</strong></label>
            <input type="number" name="Prevalence_community_second" class="form-control"
                placeholder="مقدار پیش فرض : 1" />
                <div class="errors text-danger fs-6"></div>
        </div>
    </div>
</div>
</div>`;

  const type3 = `<div class="calc-type" id="type3">
<div>
    <div class="type-title">
        <h4 class="pb-2 step-title"><span></span>مقایسه میانگین ها براساس اندازه اثر</h4>
        <img src="images/icons8-formula-100.png" class="open-formula" />
        <div class="formula-img">
            <span class="close-img">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <div>
                <h3 class="text-white text-center mb-4">محاسبه میانگین ها براساس
                    اندازه اثر
                </h3>
                <img src="images/method-3.jpg" class="w-100" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>سطح اطمینان (α)</strong></label>
            <input type="number" name="confidence_level" class="form-control"
                placeholder="مقدار پیش فرض : 0.05" />
                <div class="errors text-danger fs-6"></div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>توان آزمون (ϭ - 1)</strong></label>
            <input type="number"  name="test_power" class="form-control"
                placeholder="مقدار پیش فرض : 0.9" />
                <div class="errors text-danger fs-6"></div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>اندازه اثر (ES)</strong></label>
            <input type="number"  name="Effect_Size" class="form-control"
                placeholder="مقدار پیش فرض : 1" />
                <div class="errors text-danger fs-6"></div>
        </div>
    </div>
</div>
</div>`;

  const type4 = `<div class="calc-type" id="type4">
<div>
    <div class="type-title">
        <h4 class="pb-2 step-title"><span></span>تحلیل رگرسیون خطی</h4>
        <img src="images/icons8-formula-100.png" class="open-formula" />
        <div class="formula-img">
            <span class="close-img">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <div>
                <h3 class="text-white text-center mb-4">محاسبه رگرسیون خطی
                </h3>
                <img src="images/method-4.jpg" class="w-100" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>تعداد متغییرهای مستقل (m)</strong></label>
            <input type="number" name="Number_independent_variables" class="form-control"
                placeholder="مقدار پیش فرض : 2" />
                <div class="errors text-danger fs-6"></div>
        </div>

    </div>
</div>
</div>`;

  const type5 = `<div class="calc-type" id="type5">
<div>
    <div class="type-title">
        <h4 class="pb-2 step-title"><span></span>تحلیل رگرسیون لجستیک</h4>
        <img src="images/icons8-formula-100.png" class="open-formula" />
        <div class="formula-img">
            <span class="close-img">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <div>
                <h3 class="text-white text-center mb-4">محاسبه رگرسیون لجستیک
                </h3>
                <img src="images/method-5.jpg" class="w-100" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>تعداد متغییرهای مستقل (m)</strong></label>
            <input type="number" name="Number_independent_variables" class="form-control"
                placeholder="مقدار پیش فرض : 2" />
                <div class="errors text-danger fs-6"></div>
        </div>
    </div>
</div>
</div>`;

  const type6 = `<div class="calc-type" id="type6">
<div>
    <div class="type-title">
        <h4 class="pb-2 step-title"><span></span>برآورد شیوع</h4>
        <img src="images/icons8-formula-100.png" class="open-formula" />
        <div class="formula-img">
            <span class="close-img">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <div>
                <h3 class="text-white text-center mb-4">محاسبه برآورد شیوع
                </h3>
                <img src="images/method-6.jpg" class="w-100" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>سطح اطمینان (α)</strong></label>
            <input type="number" name="confidence_level" class="form-control"
                placeholder="مقدار پیش فرض : 0.05" />
                <div class="errors text-danger fs-6"></div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>مقدار شیوع (p)</strong></label>
            <input type="number" name="Prevalence" class="form-control"
                placeholder="مقدار پیش فرض : 0.5" />
                <div class="errors text-danger fs-6"></div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 px-2 py-3">
            <label><strong>طول بازه اطمینان (d)</strong></label>
            <input type="number" name="Length_span" class="form-control"
                placeholder="مقدار پیش فرض : 1" />
                <div class="errors text-danger fs-6"></div>
        </div>
    </div>
</div>
</div>`;

  if ($("#sample-type").find(":selected").val() == "type1") {
    $("#2").html(type1);
  } else if ($("#sample-type").find(":selected").val() == "type2") {
    $("#2").html(type2);
  } else if ($("#sample-type").find(":selected").val() == "type3") {
    $("#2").html(type3);
  } else if ($("#sample-type").find(":selected").val() == "type4") {
    $("#2").html(type4);
  } else if ($("#sample-type").find(":selected").val() == "type5") {
    $("#2").html(type5);
  } else if ($("#sample-type").find(":selected").val() == "type6") {
    $("#2").html(type6);
  }

  $(".open-formula").on("click", function (event) {
    $(this).next(".formula-img").addClass("open");
    event.stopPropagation();
    console.log('check')
    $(document).one("click", function (event) {
      if ($(".formula-img").hasClass("open") && event.tar) {
        $(".formula-img").removeClass("open");
      }
    });
  });

  $(".close-img").on("click", function () {
    $(".formula-img").removeClass("open");
  });

  $("#sample-type").on("change", function () {
    if ($(this).find(":selected").val() == "type1") {
      $("#2").html(type1);
    } else if ($(this).find(":selected").val() == "type2") {
      $("#2").html(type2);
    } else if ($(this).find(":selected").val() == "type3") {
      $("#2").html(type3);
    } else if ($(this).find(":selected").val() == "type4") {
      $("#2").html(type4);
    } else if ($(this).find(":selected").val() == "type5") {
      $("#2").html(type5);
    } else if ($(this).find(":selected").val() == "type6") {
      $("#2").html(type6);
    }

    $(".open-formula").on("click", function () {
      $(this).next(".formula-img").addClass("open");
    });

    $(".close-img").on("click", function () {
      $(".formula-img").removeClass("open");
    });
  });

  $("#min-age-check").on("change", function () {
    if ($(this).prop("checked")) {
      $(this).next(".date-box").addClass("open");
      $(this)
        .next(".date-box")
        .find("input")
        .each((index, item) => {
          item.disabled = false;
        });
    } else {
      $(this).next(".date-box").removeClass("open");
      $(this)
        .next(".date-box")
        .find("input")
        .each((index, item) => {
          item.disabled = true;
        });
    }
  });

  $("#max-age-check").on("change", function () {
    if ($(this).prop("checked")) {
      console.log("check");
      $(this).next(".date-box").addClass("open");
      $(this)
        .next(".date-box")
        .find("input")
        .each((index, item) => {
          item.disabled = false;
        });
    } else {
      $(this).next(".date-box").removeClass("open");
      $(this)
        .next(".date-box")
        .find("input")
        .each((index, item) => {
          item.disabled = true;
        });
    }
  });

  $("#submit-min-age").on("click", function (event) {
    event.preventDefault();
    $("#min-age-check").next(".date-box").removeClass("open");
  });

  $("#submit-max-age").on("click", function (event) {
    event.preventDefault();
    $("#max-age-check").next(".date-box").removeClass("open");
  });

  const regSpecial = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
  const regSpace = /\s{2,}/g;

  let s_d_speci = 0;
  $("input[name=study_specifications]").on("keypress", function (event) {
    if (event.key === "Enter") {
      study_specifications(event);
    }
  });

  $("input[name=study_specifications]")
    .next("i")
    .on("click", study_specifications);

  function study_specifications(event) {
    if ($("input[name=study_specifications]").val() == "") {
      event.preventDefault();
      $("input[name=study_specifications]")
        .next("i")
        .next(".errors")
        .css("height", "auto");
      $("input[name=study_specifications]")
        .next("i")
        .next(".errors")
        .text("* این فیلد نمی تواند خالی باشد!");
    } else if (
      regSpecial.test($("input[name=study_specifications]").val()) ||
      regSpace.test($("input[name=study_specifications]").val())
    ) {
      event.preventDefault();
      $("input[name=study_specifications]")
        .next("i")
        .next(".errors")
        .css("height", "auto");
      $("input[name=study_specifications]")
        .next("i")
        .next(".errors")
        .text("* ورودی نامعتبر است!");
    } else {
      $("input[name=study_specifications]").next("i").next(".errors").text("");
      $("#s-d-specifications>.row")
        .append(`<div class="col-12 entry-item" data-id=${s_d_speci++}>
<p>${$("input[name=study_specifications]").val()}</p>
<span class="entry-close"><i class="fa-solid fa-xmark"></i></span>
</div>`);
      $("input[name=study_specifications]").val("");
      $(".entry-close").on("click", function () {
        $(this).parent(".entry-item").remove();
      });
    }
  }

  let entry_num = 0;
  $("input[name=entry_study]").on("keypress", function (event) {
    if (event.key === "Enter") {
      entry_study(event);
    }
  });

  $("input[name=entry_study]").next("i").on("click", entry_study);

  function entry_study(event) {
    if ($("input[name=entry_study]").val() == "") {
      event.preventDefault();
      $("input[name=entry_study]")
        .next("i")
        .next(".errors")
        .css("height", "auto");
      $("input[name=entry_study]")
        .next("i")
        .next(".errors")
        .text("* این فیلد نمی تواند خالی باشد!");
    } else if (
      regSpecial.test($("input[name=entry_study]").val()) ||
      regSpace.test($("input[name=entry_study]").val())
    ) {
      event.preventDefault();
      $("input[name=entry_study]")
        .next("i")
        .next(".errors")
        .css("height", "auto");
      $("input[name=entry_study]")
        .next("i")
        .next(".errors")
        .text("* ورودی نامعتبر است!");
    } else {
      $("input[name=entry_study]").next("i").next(".errors").text("");
      $("#entry-container>.row")
        .append(`<div class="col-12 entry-item" data-id=${entry_num++}>
    <p>${$("input[name=entry_study]").val()}</p>
    <span class="entry-close"><i class="fa-solid fa-xmark"></i></span>
  </div>`);
      $("input[name=entry_study]").val("");
      $(".entry-close").on("click", function () {
        $(this).parent(".entry-item").remove();
      });
    }
  }

  let fail_entry_num = 0;
  $("input[name=failure_entry_study]").on("keypress", function (event) {
    if (event.key === "Enter") {
      failure_entry_study(event);
    }
  });

  $("input[name=failure_entry_study]")
    .next("i")
    .on("click", failure_entry_study);

  function failure_entry_study(event) {
    if ($("input[name=failure_entry_study]").val() == "") {
      event.preventDefault();
      $("input[name=failure_entry_study]")
        .next("i")
        .next(".errors")
        .css("height", "auto");
      $("input[name=failure_entry_study]")
        .next("i")
        .next(".errors")
        .text("* این فیلد نمی تواند خالی باشد!");
    } else if (
      regSpecial.test($("input[name=failure_entry_study]").val()) ||
      regSpace.test($("input[name=failure_entry_study]").val())
    ) {
      event.preventDefault();
      $("input[name=failure_entry_study]")
        .next("i")
        .next(".errors")
        .css("height", "auto");
      $("input[name=failure_entry_study]")
        .next("i")
        .next(".errors")
        .text("* ورودی نامعتبر است!");
    } else {
      $("input[name=failure_entry_study]").next("i").next(".errors").text("");
      $("#fail-entry-container>.row")
        .append(`<div class="col-12 entry-item" data-id=${fail_entry_num++}>
    <p>${$("input[name=failure_entry_study]").val()}</p>
    <span class="entry-close"><i class="fa-solid fa-xmark"></i></span>
  </div>`);
      $("input[name=failure_entry_study]").val("");
      $(".entry-close").on("click", function () {
        $(this).parent(".entry-item").remove();
      });
    }
  }

  function toggleLists(in1, in2) {
    $(in1).on("click", function () {
      if ($(this).find("i").hasClass("fa-angle-up")) {
        $(this).find("i").removeClass("fa-angle-up");
        $(this).find("i").addClass("fa-angle-down");
      } else {
        $(this).find("i").addClass("fa-angle-up");
        $(this).find("i").removeClass("fa-angle-down");
      }
      $(in2).slideToggle();
    });
  }

  toggleLists(".entry-toggle1", "#entry-container");
  toggleLists(".entry-toggle2", "#fail-entry-container");
  toggleLists(".entry-toggle3", "#s-d-specifications");

  $("input[name=termination_illness]").on("change", function () {
    if ($(this).prop("checked")) {
      $(".get-sick-container").slideDown();
      $("input[name=start_get_sick_ended]").prop("disabled", false);
      $("input[name=end_get_sick_ended]").prop("disabled", false);
    } else {
      $(".get-sick-container").slideUp();
      $("input[name=start_get_sick_ended]").prop("disabled", true);
      $("input[name=end_get_sick_ended]").prop("disabled", true);
    }
  });

  // ============= upload file =================

  $(document).ready(function () {
    $("#upload-file").change(function () {
      var filename = $(this).val();
      $("#file-upload-name").html(filename);
      if (filename != "") {
        setTimeout(function () {
          $(".upload-wrapper").addClass("uploaded");
        }, 600);
        setTimeout(function () {
          $(".upload-wrapper").removeClass("uploaded");
          $(".upload-wrapper").addClass("success");
        }, 1600);
      }
    });
  });
});
