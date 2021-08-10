$(function () {

    // $('body').css('background-color', '#fff');

    $('body').on('click', '#btn-search-store', function (e) {

        var search = $('#store_search').val();
        var formData = { search: search };

        var remoteLink = WebURL + '/audit/store/list/table/show';
        $('.table-loader').show();
        $('#tbl-store').find('tbody tr').remove();
        $('#tbl-store').find('tbody').load(remoteLink, formData, function () {

            $('.table-loader').hide();

        });

    });

    $('body').on('show.bs.modal', '#modal_acl_store', function (e) {

        $('#answer_clstore_search').val('');
        var search = $('#answer_clstore_search').val();
        var locID = $(e.relatedTarget).data('loc')

        $('#locID').val(locID);

        formData = { search: search, loc: locID };

        $('.modal-table-loader').show();
        $('.answer-store').find('tbody tr').remove();
        var remoteLink = WebURL + '/audit/active/location/checklist/table/show'
        $('.answer-store').find('tbody').load(remoteLink, formData, function () {
            $('.modal-table-loader').hide();
        });

    });

    $('body').on('click', '#btn-search-aclstore', function (e) {

        var search = $('#answer_clstore_search').val();
        var locID = $('#locID').val();

        formData = { search: search, loc: locID };

        $('.modal-table-loader').show();
        $('.answer-store').find('tbody tr').remove();
        var remoteLink = WebURL + '/audit/active/location/checklist/table/show'
        $('.answer-store').find('tbody').load(remoteLink, formData, function () {
            $('.modal-table-loader').hide();
        });

    });

    $('body').on('click', '.answer-store tbody tr.row-click', function (e) {

        var clID = $(this).data('clid');
        var locID = $('#locID').val();

        formData = { cl: clID, loc: locID };

        $.post(WebURL + '/answer/audit/location/start', formData, function (data) {
            if (data.num > 0) {

                console.log(data.msg);
                window.location = WebURL + '/answer/audit/location/' + btoa(data.num);
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