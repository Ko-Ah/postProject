(function ($) {
    "use strict";
    //table_id4 section
    var table4 = $("#table_id4").DataTable({

        createdRow: function (row, data, index) {
            $(row).addClass("selected");
        },
    });

    table4.on("click", "tbody tr", function () {
        var $row = table4.row(this).nodes().to$();
        var hasClass = $row.hasClass("selected");
        if (hasClass) {
            $row.removeClass("selected");
        } else {
            $row.addClass("selected");
        }
    });
    table4.rows().every(function () {
        this.nodes().to$().removeClass("selected");
    });

})(jQuery);
