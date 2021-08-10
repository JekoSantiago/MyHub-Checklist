$(function () {

    var answerCLID = $('#aclID').val();
    loadCategoryTree(answerCLID);

    if ($('#categoryCount').val() < 2) {

        var aCTGID = $('#active_ctgID').val();
        var aCLID = $('#aclID').val();

        var formData = { actg: aCTGID, acl: aCLID }

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/audit/rca/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, formData, function () {
            loadDropzone();
            $('.cover-spin-content').hide();
            $('.input-date').flatpickr({
                disableMobile: "true"
            });
            $('.input-time').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: "true"
            });

        });
    }

    $('#modal_disapprove_remarks').on('show.bs.modal', function(e) {
        
        var auditLocID = $(e.relatedTarget).data('id');

        var remoteLink = WebURL + '/audit/location/disapprove/show';
        $(this).find('.modal-body').load(remoteLink, formData, function () {
            $('#auditID').val(auditLocID);
        });
    });

    $('body').on('click', '#submit_rca', function (e) {

        var auditID = $(this).data('id');
        var aclID = $('#aclID').val();
        var answerChecklist = { id: aclID };
        var formData = { id: auditID };

        swal({
            title: "Are you sure?",
            text: "You are about to submit your response and corrective actions",
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
                    $.post(WebURL + '/rca/items/done/check', answerChecklist, function (data) {
                        var count = data.length;
            
                        if (count > 0) {
                            if (parseInt(data[0].Findings) === parseInt(data[0].TotalDone)) {
                                $.post(WebURL + '/rca/audit/location/submit', formData, function (data) {
                                    if (data.num > 0) {
                                        console.log(data.msg);
                                        
                                        swal({
                                            title: "Success",
                                            text: data.msg,
                                            confirmButtonColor: "#2E7D32",
                                            type: "success",
                                            closeOnConfirm: false,
                                        },
                                        function(isConfirm){
                                            if (isConfirm) {
                                                window.location = WebURL + '/rca';
                                            }
                                        });
                                    }
                                    else {
                                        swal({
                                            title: "Error!",
                                            text: data.msg,
                                            confirmButtonColor: "#2E7D32",
                                            type: "error"
                                        });
                                    }
                                }, 'JSON');
                            }
                            else {
                                swal({
                                    title: "Error!",
                                    text: "Please put your response and actions for every findings found.",
                                    confirmButtonColor: "#2E7D32",
                                    type: "error"
                                });
                            }
                        }
                        else {
                            swal({
                                title: "Error!",
                                text: "Server Error no data retrieved for checking.",
                                confirmButtonColor: "#2E7D32",
                                type: "error"
                            });
                        }
                    }, 'JSON');
                }
            });
        
    });

    $('body').on('click', '.ctg-link', function () {

        var aCTGID = $(this).data('id');
        var aCLID = $('#aclID').val();
        $('#active_ctgID').val(aCTGID);

        var formData = { actg: aCTGID, acl: aCLID }

        console.log(aCTGID);
        console.log(aCLID);

        if ($('body').hasClass('mobile-view')) {
            $('body').toggleClass('category-nav-collapse');
        }

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/audit/rca/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, formData, function () {
            $(window).scrollTop(0);
            loadDropzone();
            $('.parent-category > span').removeClass('active');
            $('.span-' + aCTGID).addClass('active');

            $('.cover-spin-content').hide();
            $('.input-date').flatpickr({
                disableMobile: "true"
            });
            $('.input-time').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: "true"
            });

        });
    });

    $('body').on('click', '.previous', function (e) {
        e.preventDefault();

        var aCTGID = $(this).data('id');
        var aCLID = $('#aclID').val();
        $('#active_ctgID').val(aCTGID);

        var formData = { actg: aCTGID, acl: aCLID }

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/audit/rca/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, formData, function () {
            $(window).scrollTop(0);
            loadDropzone();
            $('.parent-category > span').removeClass('active');
            $('.span-' + aCTGID).addClass('active');

            $('.cover-spin-content').hide();
            $('.input-date').flatpickr({
                disableMobile: "true"
            });
            $('.input-time').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: "true"
            });
        });
    });

    $('body').on('click', '.next', function (e) {
        e.preventDefault();

        var aCTGID = $(this).data('id');
        var aCLID = $('#aclID').val();
        $('#active_ctgID').val(aCTGID);

        var formData = { actg: aCTGID, acl: aCLID }

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/audit/rca/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, formData, function () {
            $(window).scrollTop(0);
            loadDropzone();
            $('.parent-category > span').removeClass('active');
            $('.span-' + aCTGID).addClass('active');

            $('.cover-spin-content').hide();
            $('.input-date').flatpickr({
                disableMobile: "true"
            });
            $('.input-time').flatpickr({
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                disableMobile: "true"
            });
        });
    });

    $('body').on('click', '#btn-approve', function (e) {
        e.preventDefault();

        var acl_ID = $(this).data('id');
        var approve = 1;
        var remarks = '';

        var formData = { id: acl_ID, approve: approve, remarks: remarks }

        console.log(formData);

        swal({
            title: "Are you sure?",
            text: "You are about to approve this audit",
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
                    $.post(WebURL + '/audit/location/approval/insert', formData, function (data) {
                        if (data.num > 0) {
                            console.log(data.msg);
            
                            swal({
                                title: "Success",
                                text: data.msg,
                                confirmButtonColor: "#2E7D32",
                                type: "success",
                                closeOnConfirm: false,
                            },
                            function(isConfirm){
                                if (isConfirm) {
                                    window.location = WebURL + data.red;
                                }
                            });
                        }
                        else {
                            swal({
                                title: "Error!",
                                text: data.msg,
                                confirmButtonColor: "#2E7D32",
                                type: "error"
                            });
                        }
                    }, 'JSON');
                }
            });
        
    });

    $('body').on('click', '#btn-disapprove', function (e) {
        e.preventDefault();

        var acl_ID = $('#auditID').val();
        var remarks = $('#disapprove_remarks').val();
        var approve = 0;

        var formData = { id: acl_ID, approve: approve, remarks: remarks }
        
        if (remarks != "") {
            swal({
                title: "Are you sure?",
                text: "You are about to disapprove this audit",
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
                        $.post(WebURL + '/audit/location/approval/insert', formData, function (data) {
                            if (data.num > 0) {
                                console.log(data.msg);
                
                                swal({
                                    title: "Success",
                                    text: data.msg,
                                    confirmButtonColor: "#2E7D32",
                                    type: "success",
                                    closeOnConfirm: false,
                                },
                                function(isConfirm){
                                    if (isConfirm) {
                                        window.location = WebURL + data.red;
                                    }
                                });
                            }
                            else {
                                swal({
                                    title: "Error!",
                                    text: data.msg,
                                    confirmButtonColor: "#2E7D32",
                                    type: "error"
                                });
                            }
                        }, 'JSON');
                    }
                });
        }
        else {
            swal({
                title: "Ooops!",
                text: "Please input remarks for your disapproval.",
                confirmButtonColor: "#2E7D32",
                type: "warning"
            });
        }

        
    });

    $('body').on('change', 'form.item_form textarea', function (e) {

        var answerItem_ID = $(this).data('id');
        var problems = $('#pf_' + answerItem_ID).val();
        var response = $('#response_' + answerItem_ID).val();
        var action = $('#at_'+ answerItem_ID). val();
        var aCTGID = $('#active_ctgID').val();

        formData = { id:answerItem_ID, f:problems, r:response, a:action };

        $.post(WebURL + '/answer/audit/rca/insert', formData, function (data) {
            if (data.num > 0) {
                console.log(data.msg);

                if(problems != '' && response != '' && action != '') {
                    if ($('i.alert-'+ aCTGID).hasClass('fa-exclamation-circle')) {
                        $('i.alert-'+ aCTGID).addClass('fa-check-circle text-success').removeClass('fa-exclamation-circle text-danger');
                    }
                } 
                else if(problems == '' && response == '' && action == '') {
                    $('i.alert-'+ aCTGID).removeClass('fa-exclamation-circle text-danger');
                }
                else {
                    if ($('i.alert-'+ aCTGID).hasClass('fa-check-circle')) {
                        $('i.alert-'+ aCTGID).addClass('fa-exclamation-circle text-danger').removeClass('fa-check-circle text-success');
                    }
                    else {
                        $('i.alert-'+ aCTGID).addClass('fas fa-exclamation-circle text-danger');
                    }
                }
            }
            else {
                swal({
                    title: "Error!",
                    text: data.msg,
                    confirmButtonColor: "#2E7D32",
                    type: "error"
                });
            }
        }, 'JSON');

    })


})


function loadCategoryTree(answerCLID) {
    var remoteLink = WebURL + '/answer/rca/category/show/' + answerCLID;
    $('.cover-spin-sidenav').show();
    $('.category-nav').find('.sidenav-body').load(remoteLink, function () {

        $('.cover-spin-sidenav').hide();

    });
}

function loadDropzone() {
    $("body").find("form.dropzone").each(function (i) {
        var item_id = $(this).data("id");

        $(this).dropzone({
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            removedfile: function(file) {
                var name = file.name; 
                var formData = { id: item_id, name: name }
                
                $.ajax({
                  type: 'POST',
                  url: WebURL + '/answer/item/file-delete',
                  data: formData,
                  success: function(data) {
                      console.log(data);
                      if(data.status == true) {
                        console.log(data.message);
                        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                      }
                      else {
                        swal({
                            title: "Error!",
                            text: data.message,
                            confirmButtonColor: "#2E7D32",
                            type: "error"
                        });
                      }
                  },
                  error: function(data) {
                    swal({
                        title: "Error!",
                        text: "Server error, please contact system administrator.",
                        confirmButtonColor: "#2E7D32",
                        type: "error"
                    });
                  }
                });
                
              },
            init: function () {
                var myDropzone = this;
                $.ajax({
                    url: WebURL + "/upload/get/" + item_id,
                    type: "get",
                    dataType: "json",
                    success: function (response) {

                        $.each(response, function (key, value) {
                            console.log(value.path);
                            var mockFile = {
                                name: value.name,
                                size: value.size,
                            };
                            myDropzone.files.push(mockFile);
                            myDropzone.emit("addedfile", mockFile);
                            myDropzone.emit(
                                "thumbnail",
                                mockFile,
                                WebURL + "/" + value.path
                            );
                            myDropzone.emit("complete", mockFile);
                        });
                    },
                    error: function (response) {
                        console.log(response);
                    },
                });

                myDropzone.on('success', function (file, response) {

                    if (response.status == false) {
                        file.previewElement.classList.remove("dz-success");
                        file.previewElement.classList.add("dz-error");

                        var _iteratorNormalCompletion7 = true;
                        var _didIteratorError7 = false;
                        var _iteratorError7 = undefined;

                        try {
                            for (var _iterator7 = file.previewElement.querySelectorAll("[data-dz-errormessage]")[Symbol.iterator](), _step7; !(_iteratorNormalCompletion7 = (_step7 = _iterator7.next()).done); _iteratorNormalCompletion7 = true) {
                                var node = _step7.value;
                                node.textContent = response.message;
                            }
                        } catch (err) {
                            _didIteratorError7 = true;
                            _iteratorError7 = err;
                        } finally {
                            try {
                                if (!_iteratorNormalCompletion7 && _iterator7["return"] != null) {
                                    _iterator7["return"]();
                                }
                            } finally {
                                if (_didIteratorError7) {
                                    throw _iteratorError7;
                                }
                            }
                        }

                    }
                });
            },
        });
    });
}