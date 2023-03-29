$(document).ready(function () {
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
        $(".tags-container").append(
            ` <input type="hidden" name="removetag[]" id="removeTag" value="  ${$(event.target).parent(".tag-item").text()} "/>`)

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
                .text("* برچسب وارد شده صحیح نمی باشد!");
        } else {
            $(".tags-container").append(
                `<a class="tag-item">
      <i class="fa-solid fa-xmark align-middle"></i>
      ${$(".post-tags").val()} <input type="hidden" name="tag[]" id="InputVal" value="  ${$(".post-tags").val()} "/>
  </a>`
            );


            $(".tag-item i").off("click",removeTag );
             $(".tag-item i").on("click",removeTag);

            $(".post-tags").val("");
            $(".post-tags").siblings(".errors").text("");
            var aNum = $(".tag-item");
            //  console.log(aNum.length)
            var InputVal = document.getElementsByName('tag[]');
            var inputVal='';
            var arr=[]
            for(var i=0;i<InputVal.length;i++){
                var content=InputVal[i].value;
                inputVal =content.trim();
                arr.push(inputVal);
                $('#tagValue').val(arr)

            }
        }
    }
});
