$(function () {

    // $('body').css('background-color', '#fff');

    $('body').on('click', '#btn-search-department', function (e) {

        var search = $('#department_search').val();
        var formData = { search: search };

        var remoteLink = WebURL + '/audit/department/list/table/show';
        $('.table-loader').show();
        $('#tbl-department').find('tbody tr').remove();
        $('#tbl-department').find('tbody').load(remoteLink, formData, function () {

            $('.table-loader').hide();

        });

    });

    $('body').on('show.bs.modal', '#modal_acl_dep', function (e) {

        $('#answer_cldep_search').val('');
        var search = $('#answer_cldep_search').val();
        var locID = $(e.relatedTarget).data('loc')
        var depID = $(e.relatedTarget).data('dep')

        $('#locID').val(locID);
        $('#depID').val(depID);

        formData = { search: search, loc: locID, dep: depID };

        $('.modal-table-loader').show();
        $('.answer-department').find('tbody tr').remove();
        var remoteLink = WebURL + '/audit/active/department/checklist/table/show'
        $('.answer-department').find('tbody').load(remoteLink, formData, function () {
            $('.modal-table-loader').hide();
        });

    });

    $('body').on('click', '#btn-search-acldep', function (e) {

        var search = $('#answer_cldep_search').val();
        var locID = $('#locID').val();
        var depID = $('#depID').val();

        formData = { search: search, loc: locID, dep: depID };

        $('.modal-table-loader').show();
        $('.answer-department').find('tbody tr').remove();
        var remoteLink = WebURL + '/audit/active/department/checklist/table/show'
        $('.answer-department').find('tbody').load(remoteLink, formData, function () {
            $('.modal-table-loader').hide();
        });

    });

    $('body').on('click', '.answer-department tbody tr.row-click', function (e) {

        var clID = $(this).data('clid');
        var locID = $('#locID').val();
        var depID = $('#depID').val();

        formData = { cl: clID, loc: locID, dep: depID };

        $.post(WebURL + '/answer/audit/department/start', formData, function (data) {
            if (data.num > 0) {

                console.log(data.msg);
                window.location = WebURL + '/answer/audit/department/' + btoa(data.num);
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

    });
})