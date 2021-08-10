$(function () {

    $('body').on('show.bs.modal', '#modal_myanswer_filter', function () {

        var checklist = $('#cl-search').val();
        var datestart = $('#datestart-search').val();
        var dateend = $('#dateend-search').val();
        var issubmit = $('#submit-search').val();
        var formData = { cl: checklist, ds: datestart, de: dateend, is: issubmit }

        var remoteLink = WebURL + '/answer/filter/table/show';
        $('#modal_myanswer_filter').find('.modal-body').load(remoteLink, formData, function () {
            $('#datestart').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
            $('#dateend').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
        });

    });

    $('body').on('click', '#btn-apply-filter', function () {

        var cl = $('#checklist').val();
        var ds = $('#datestart').val();
        var de = $('#dateend').val();
        var splitds = ds.split(' to ');
        var splitde = de.split(' to ');
        var dsfrom = splitds[0];
        var dsto = splitds[1];
        var defrom = splitde[0];
        var deto = splitde[1];

        if (dsto == '') {
            dsto = dsfrom;
        }

        if (deto == '') {
            deto = defrom;
        }

        if ($('#isSubmit').is(':checked')) {
            var is = 1;
        }
        else {
            var is = 2;
        }

        $('#cl-search').val(cl);
        $('#datestart-search').val(ds);
        $('#dateend-search').val(de);
        $('#submit-search').val(is);

        var formData = { cl: cl, submit: is, sdf: dsfrom, sdt: dsto, edf: defrom, eft: deto };
        var remoteLink = WebURL + '/answer/checklist/table/show'
        $('.table-loader').show();
        $('#tbl-answered').find('tbody tr').remove();
        $('#tbl-answered').find('tbody').load(remoteLink, formData, function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('.table-loader').hide();
        });

    });

    $('body').on('click', '#btn-reset-filter', function () {
        $('#checklist').val('');
        $('#datestart').val('');
        $('#dateend').val('');
        $('#isSubmit').prop('checked', false);
    })

})