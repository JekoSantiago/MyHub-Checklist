$(function () {
    var answerCLID = $("#aclID").val();
    loadCategoryTree(answerCLID);

    if ($("#categoryCount").val() < 2) {
        var aCTGID = $("#active_ctgID").val();
        var aCLID = $("#aclID").val();

        var formData = { actg: aCTGID, acl: aCLID };

        $(".cover-spin-content").show();
        var remoteLink = WebURL + "/answer/question/show";
        $(".checklist-container")
            .find(".checklist-body")
            .load(remoteLink, formData, function () {
                
                $(".cover-spin-content").hide();
                $(".input-date").flatpickr({
                    disableMobile: "true",
                });
                $(".input-time").flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    disableMobile: "true",
                });
            });
    }

    $("body").on("click", ".ctg-link", function () {
        var aCTGID = $(this).data("id");
        var aCLID = $("#aclID").val();
        $("#active_ctgID").val(aCTGID);

        var formData = { actg: aCTGID, acl: aCLID };

        console.log(aCTGID);
        console.log(aCLID);

        if ($("body").hasClass("mobile-view")) {
            $("body").toggleClass("category-nav-collapse");
        }

        $(".cover-spin-content").show();
        var remoteLink = WebURL + "/answer/question/show";
        $(".checklist-container")
            .find(".checklist-body")
            .load(remoteLink, formData, function () {
                $(window).scrollTop(0);

                $(".parent-category > span").removeClass("active");
                $(".span-" + aCTGID).addClass("active");

                $(".cover-spin-content").hide();
                $(".input-date").flatpickr({
                    disableMobile: "true",
                });
                $(".input-time").flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    disableMobile: "true",
                });
            });
    });

    $("body").on("change", ".custom-input input, .custom-input textarea",
        function (e) {
            e.stopPropagation();

            var answeritemID = $(this).data("id");
            var answer = $(this).val();
            var answerCLID = $("#aclID").val();
            var answerCtgID = $("#active_ctgID").val();
            var formData = { id: answeritemID, answer: answer };
            var checkData = { id: answerCLID, category: answerCtgID };

            $.post(
                WebURL + "/answer/input/update",
                formData,
                function (data) {
                    if (data.num > 0) {
                        console.log(data.msg);

                        $.post(
                            WebURL + "/answer/items/done/check",
                            checkData,
                            function (data) {
                                if (data.num == 0) {
                                    $(".span-" + answerCtgID).addClass(
                                        "required-items-done"
                                    );
                                }
                            },
                            "JSON"
                        );
                    } else {
                        swal({
                            title: "Error!",
                            text: data.msg,
                            confirmButtonColor: "#2E7D32",
                            type: "error",
                        });
                    }
                },
                "JSON"
            );
        }
    );

    $("body").on("change", ".answer-select", function (e) {
        var answeritemID = $(this).data("id");
        var answeroptionID = $(this).val();
        var answerCLID = $("#aclID").val();
        var answerCtgID = $("#active_ctgID").val();
        var formData = { aid: answeritemID, oid: answeroptionID };
        var checkData = { id: answerCLID, category: answerCtgID };

        $.post(
            WebURL + "/answer/selected/update",
            formData,
            function (data) {
                if (data.num > 0) {
                    console.log(data.msg);

                    $.post(
                        WebURL + "/answer/items/done/check",
                        checkData,
                        function (data) {
                            if (data.num == 0) {
                                $(".span-" + answerCtgID).addClass(
                                    "required-items-done"
                                );
                            }
                        },
                        "JSON"
                    );
                } else {
                    swal({
                        title: "Error!",
                        text: data.msg,
                        confirmButtonColor: "#2E7D32",
                        type: "error",
                    });
                }
            },
            "JSON"
        );
    });

    $("body").on("click", ".custom-radio input", function (e) {
        var answeritemID = $(this).data("id");
        var answeroptionID = $(this).val();
        var answerCLID = $("#aclID").val();
        var answerCtgID = $("#active_ctgID").val();
        var formData = { aid: answeritemID, oid: answeroptionID };
        var checkData = { id: answerCLID, category: answerCtgID };

        $.post(
            WebURL + "/answer/selected/update",
            formData,
            function (data) {
                if (data.num > 0) {
                    console.log(data.msg);

                    $.post(
                        WebURL + "/answer/items/done/check",
                        checkData,
                        function (data) {
                            if (data.num == 0) {
                                $(".span-" + answerCtgID).addClass(
                                    "required-items-done"
                                );
                            }
                        },
                        "JSON"
                    );
                } else {
                    swal({
                        title: "Error!",
                        text: data.msg,
                        confirmButtonColor: "#2E7D32",
                        type: "error",
                    });
                }
            },
            "JSON"
        );
    });

    $("body").on("click", ".custom-checkbox input", function (e) {
        var bool = $(this).is(":checked");
        var optionID = $(this).val();
        var answerCLID = $("#aclID").val();
        var answerCtgID = $("#active_ctgID").val();

        if (bool == true) {
            var checked = 1;
        } else {
            var checked = 0;
        }

        var formData = { oid: optionID, bool: checked };
        var checkData = { id: answerCLID, category: answerCtgID };

        $.post(
            WebURL + "/answer/checked/update",
            formData,
            function (data) {
                if (data.num > 0) {
                    console.log(data.msg);

                    $.post(
                        WebURL + "/answer/items/done/check",
                        checkData,
                        function (data) {
                            if (data.num == 0) {
                                $(".span-" + answerCtgID).addClass(
                                    "required-items-done"
                                );
                            }
                        },
                        "JSON"
                    );
                } else {
                    swal({
                        title: "Error!",
                        text: data.msg,
                        confirmButtonColor: "#2E7D32",
                        type: "error",
                    });
                }
            },
            "JSON"
        );
    });

    $("body").on("change", ".remarks-container input", function (e) {
        var answeritemID = $(this).data("id");
        var remarks = $(this).val();
        var formData = { id: answeritemID, remarks: remarks };

        $.post(
            WebURL + "/answer/remarks/update",
            formData,
            function (data) {
                if (data.num > 0) {
                    console.log(data.msg);
                } else {
                    swal({
                        title: "Error!",
                        text: data.msg,
                        confirmButtonColor: "#2E7D32",
                        type: "error",
                    });
                }
            },
            "JSON"
        );
    });

    $("body").on("click", "#submit-answer", function (e) {
        var answerCLID = $("#aclID").val();
        var formData = { id: answerCLID };

        swal(
            {
                title: "Are you sure?",
                text: "Submit answers for this checklist",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ffcc00",
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.post(
                        WebURL + "/answer/items/required/check",
                        formData,
                        function (data) {
                            console.log(data);
                            var count = data.length;
                            $(".category-nav")
                                .find("span")
                                .removeClass("category-require");

                            if (count > 0) {
                                for (var i = 0; i < count; i++) {
                                    var c =
                                        ".span-" + data[i].AnswerCategory_ID;
                                    $(c).addClass("category-require");
                                }

                                swal({
                                    title: "Error!",
                                    text: "Please answer all required items!",
                                    confirmButtonColor: "#ffcc00",
                                    type: "error",
                                });
                            } else {
                                $.post(
                                    WebURL + "/answer/submit",
                                    formData,
                                    function (data) {
                                        if (data.num > 0) {
                                            console.log(data.msg);

                                            swal(
                                                {
                                                    title: "Success",
                                                    text: data.msg,
                                                    confirmButtonColor:
                                                        "#2E7D32",
                                                    type: "success",
                                                    closeOnConfirm: false,
                                                },
                                                function (isConfirm) {
                                                    if (isConfirm) {
                                                        window.location =
                                                            WebURL + data.route;
                                                    }
                                                }
                                            );
                                        } else {
                                            swal({
                                                title: "Error!",
                                                text: data.msg,
                                                confirmButtonColor: "#2E7D32",
                                                type: "error",
                                            });
                                        }
                                    },
                                    "JSON"
                                );
                            }
                        },
                        "JSON"
                    );
                }
            }
        );
    });

    $("body").on("click", ".previous", function (e) {
        e.preventDefault();

        var aCTGID = $(this).data("id");
        var aCLID = $("#aclID").val();
        $("#active_ctgID").val(aCTGID);

        var formData = { actg: aCTGID, acl: aCLID };

        $(".cover-spin-content").show();
        var remoteLink = WebURL + "/answer/question/show";
        $(".checklist-container")
            .find(".checklist-body")
            .load(remoteLink, formData, function () {
                $(window).scrollTop(0);
                $(".parent-category > span").removeClass("active");
                $(".span-" + aCTGID).addClass("active");

                $(".cover-spin-content").hide();
                $(".input-date").flatpickr({
                    disableMobile: "true",
                });
                $(".input-time").flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    disableMobile: "true",
                });
            });
    });

    $("body").on("click", ".next", function (e) {
        e.preventDefault();

        var aCTGID = $(this).data("id");
        var aCLID = $("#aclID").val();
        $("#active_ctgID").val(aCTGID);

        var formData = { actg: aCTGID, acl: aCLID };

        $(".cover-spin-content").show();
        var remoteLink = WebURL + "/answer/question/show";
        $(".checklist-container")
            .find(".checklist-body")
            .load(remoteLink, formData, function () {
                $(window).scrollTop(0);
                $(".parent-category > span").removeClass("active");
                $(".span-" + aCTGID).addClass("active");

                $(".cover-spin-content").hide();
                $(".input-date").flatpickr({
                    disableMobile: "true",
                });
                $(".input-time").flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    disableMobile: "true",
                });
            });
    });
});

function loadCategoryTree(answerCLID) {
    var aCTGID = $("#active_ctgID").val();

    var remoteLink = WebURL + "/answer/category/show/" + answerCLID;
    $(".cover-spin-sidenav").show();
    $(".category-nav")
        .find(".sidenav-body")
        .load(remoteLink, function () {
            $(".parent-category > span").removeClass("active");
            $(".span-" + aCTGID).addClass("active");

            $(".cover-spin-sidenav").hide();
            console.log($('.checklist-container').prev());
        });
}