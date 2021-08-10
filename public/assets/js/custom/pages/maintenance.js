$(function () {

    var search = $('#checklist_search').val();
    loadChecklistTable(search)

    $('body').on('click', '.maintenance tbody tr.row-click', function (e) {
        e.stopPropagation();

        var clid = $(this).data('clid');
        window.location = WebURL + '/maintenance/checklist/edit/' + clid;
    });

    $('#modal_new_cl').on('show.bs.modal', function (e) {

        var remoteLink = WebURL + '/maintenance/checklist/add/show'
        $('#modal_new_cl').find('.modal-body').load(remoteLink, function () {

        });

    });

    $('body').on('click', '#btn-search-checklist', function () {

        var search = $('#checklist_search').val();
        loadChecklistTable(search)
    })

    $('body').on('click', '.deactivate-cl', function (e) {
        e.stopPropagation();
        
        var id = $(this).data('id');
        var active = 0;
        var search = $('#checklist_search').val();
        var formData = { id: id, active: active };

        $.post(WebURL + '/checklist/activate', formData, function (data) {
            if (data.num > 0) {
                console.log(data.msg);

                swal({
                    title: 'Success!',
                    text: data.msg,
                    type: 'success',
                    confirmButtonText: 'Ok',
                },
                    function (isConfirm) {
                        if (isConfirm) {
                            var remoteLinkTable = WebURL + '/maintenance/checklist/table/show';
                            $('.maintenance.table-checklist').find('tbody').load(remoteLinkTable, {search:search}, function () {
                                $('[data-toggle="tooltip"]').tooltip();
                            });
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

    })

    $('body').on('click', '.activate-cl', function (e) {
        e.stopPropagation();
        
        var id = $(this).data('id');
        var active = 1;
        var search = $('#checklist_search').val();
        var formData = { id: id, active: active };

        $.post(WebURL + '/checklist/activate', formData, function (data) {
            if (data.num > 0) {
                console.log(data.msg);

                swal({
                    title: 'Success!',
                    text: data.msg,
                    type: 'success',
                    confirmButtonText: 'Ok',
                },
                    function (isConfirm) {
                        if (isConfirm) {
                            var remoteLinkTable = WebURL + '/maintenance/checklist/table/show';
                            $('.maintenance.table-checklist').find('tbody').load(remoteLinkTable, {search:search}, function () {
                                $('[data-toggle="tooltip"]').tooltip();
                            });
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

    })

    $('body').on('click', '.delete-cl', function (e) {
        e.stopPropagation();
        
        var id = $(this).data('id');
        var search = $('#checklist_search').val();
        var formData = { id: id };

        swal({
            title: "Are you sure?",
            text: "You're about to delete a Checklist",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#ffcc00",
            confirmButtonText: "Yes",
            cancelButtonText: "Cancel",
            closeOnConfirm: true,
          },
            function (isConfirm) {
              if (isConfirm) {
                $.post(WebURL + '/checklist/delete', formData, function (data) {
                    if (data.num > 0) {
                        console.log(data.msg);
        
                        swal({
                            title: 'Success!',
                            text: data.msg,
                            type: 'success',
                            confirmButtonText: 'Ok',
                        },
                            function (isConfirm) {
                                if (isConfirm) {
                                    var remoteLinkTable = WebURL + '/maintenance/checklist/table/show';
                                    $('.maintenance.table-checklist').find('tbody').load(remoteLinkTable, { search:search }, function () {
                                        $('[data-toggle="tooltip"]').tooltip();
                                    });
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

    })

    $('body').on('click', '#btn-save-cl', function () {

        var error = false;
        var title = $('#title').val();
        var type = $('#type').val();
        var formdata = $('#new_checklist').serialize();

        if (title.length == 0) {
            var error = true;
            $('#newcltitleerror').show();
        } else {
            $('#newcltitleerror').hide();
        }

        if (type == null) {
            var error = true;
            $('#newcltypeerror').show();
        } else {
            $('#newcltypeerror').hide();
        }

        if (error == false) {

            $.ajax({
                url: WebURL + '/checklist/add',
                type: 'POST',
                data: formdata,
                success: function (data) {

                    if (data.num > 0) {
                        swal({
                            title: 'Success!',
                            text: data.msg,
                            type: 'success',
                            confirmButtonText: 'Ok',
                        },
                            function (isConfirm) {
                                if (isConfirm) {
                                    window.location = WebURL + '/maintenance/checklist/edit/' + btoa(data.num);
                                }
                            });
                    } else {
                        swal({
                            title: "Warning!",
                            text: data.msg,
                            type: "warning",
                            confirmButtonText: "Ok"
                        });
                    }
                }
            })

        }


    });

})

function loadChecklistTable(search) {

    formData = { search: search };

    $('.table-loader').show();
    $('.table-checklist').find('tbody tr').remove();
    var remoteLinkTable = WebURL + '/maintenance/checklist/table/show';
    $('.maintenance.table-checklist').find('tbody').load(remoteLinkTable, formData, function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('.table-loader').hide();
    });
}