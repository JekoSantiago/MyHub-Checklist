$(function () {

    $('body').on('show.bs.modal', '#modal_mystore_filter', function () {

        var location = $('#loc-search').val();
        var checklist = $('#cl-search').val();
        var datestart = $('#datestart-search').val();
        var dateend = $('#dateend-search').val();
        var issubmit = $('#submit-search').val();
        var formData = { loc: location, cl: checklist, ds: datestart, de: dateend, is: issubmit }

        var remoteLink = WebURL + '/audit/location/filter/show';
        $('#modal_mystore_filter').find('.modal-body').load(remoteLink, formData, function () {
            $('#datestart').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
            $('#dateend').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });

            $('.select2-search').select2({
                placeholder: "Select a store"
            });

        });

    });

    
    

    $('body').on('show.bs.modal', '#modal_mydep_filter', function () {

        var location = $('#ad-loc-search').val();
        var department = $('#ad-dep-search').val();
        var checklist = $('#ad-cl-search').val();
        var datestart = $('#ad-datestart-search').val();
        var dateend = $('#ad-dateend-search').val();
        var issubmit = $('#ad-submit-search').val();
        var formData = { loc: location, dep: department, cl: checklist, ds: datestart, de: dateend, is: issubmit }

        var remoteLink = WebURL + '/audit/department/filter/show';
        $('#modal_mydep_filter').find('.modal-body').load(remoteLink, formData, function () {
            $('#ad-datestart').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
            $('#ad-dateend').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
            $('.select2-search').select2({
                placeholder: "Select location"
            });
        });

    });

    $('body').on('click', '#modal_mystore_filter #btn-apply-filter', function () {

        var loc = $('#location').val();
        var cl = $('#checklist').val();
        var ds = $('#datestart').val();
        var de = $('#dateend').val();
        var splitds = ds.split(' to ');
        var splitde = de.split(' to ');
        var dsfrom = splitds[0];
        var dsto = splitds[1];
        var defrom = splitde[0];
        var deto = splitde[1];

        if (!dsto) {
            dsto = dsfrom;
        }
        
        if (!deto) {
            deto = defrom;
        }

        if ($('#isSubmit').is(':checked')) {
            var is = 1;
        }
        else {
            var is = 0;
        }

        $('#loc-search').val(loc);
        $('#cl-search').val(cl);
        $('#datestart-search').val(ds);
        $('#dateend-search').val(de);
        $('#submit-search').val(is);

        var formData = { loc: loc, cl: cl, submit: is, sdf: dsfrom, sdt: dsto, edf: defrom, edt: deto };
        var remoteLink = WebURL + '/audit/location/table/show'
        $('.table-loader').show();
        $('#tbl-my-store').find('tbody tr').remove();
        $('#tbl-my-store').find('tbody').load(remoteLink, formData, function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('.table-loader').hide();
        });

    });

    $('body').on('click', '#modal_mydep_filter #btn-apply-filter', function () {

        var loc = $('#ad-location').val();
        var dep = $('#ad-department').val();
        var cl = $('#ad-checklist').val();
        var ds = $('#ad-datestart').val();
        var de = $('#ad-dateend').val();
        var splitds = ds.split(' to ');
        var splitde = de.split(' to ');
        var dsfrom = splitds[0];
        var dsto = splitds[1];
        var defrom = splitde[0];
        var deto = splitde[1];

        if (!dsto) {
            dsto = dsfrom;
        }
        
        if (!deto) {
            deto = defrom;
        }

        if ($('#ad-isSubmit').is(':checked')) {
            var is = 1;
        }
        else {
            var is = 0;
        }

        $('#ad-loc-search').val(loc);
        $('#ad-dep-search').val(dep);
        $('#ad-cl-search').val(cl);
        $('#ad-datestart-search').val(ds);
        $('#ad-dateend-search').val(de);
        $('#ad-submit-search').val(is);

        var formData = { loc: loc, dep: dep, cl: cl, submit: is, sdf: dsfrom, sdt: dsto, edf: defrom, edt: deto };
        var remoteLink = WebURL + '/audit/department/table/show'
        $('.table-loader').show();
        $('#tbl-my-department').find('tbody tr').remove();
        $('#tbl-my-department').find('tbody').load(remoteLink, formData, function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('.table-loader').hide();
        });

    });

    $('body').on('click', '#store-reset-filter', function () {
        $('#location').val(0).change();
        $('#checklist').val('');
        $('#datestart').val('');
        $('#dateend').val('');
        $('#isSubmit').prop('checked', false);
    })

    $('body').on('click', '#dep-reset-filter', function () {
        $('#ad-location').val(0).change();
        $('#ad-department').val(0).change();
        $('#ad-checklist').val('');
        $('#ad-datestart').val('');
        $('#ad-dateend').val('');
        $('#ad-isSubmit').prop('checked', false);
    })
})