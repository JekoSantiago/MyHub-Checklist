$(function () {

    $('#monthRange').flatpickr({
        mode: 'range',
        dateFormat: 'Y-m-d',
    });

    $('body').on('show.bs.modal', '#modal_rptstore_filter', function () {

        var location = $('#store-loc-search').val();
        var checklist = $('#store-cl-search').val();
        var datestart = $('#store-datestart-search').val();
        var dateend = $('#store-dateend-search').val();
        var formData = { loc: location, cl: checklist, ds: datestart, de: dateend }

        var remoteLink = WebURL + '/reports/location/filter/show';
        $('#modal_rptstore_filter').find('.modal-body').load(remoteLink, formData, function () {
            $('#store-datestart').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
            
            $('#store-dateend').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
        });

    });

    $('body').on('show.bs.modal', '#modal_rptdep_filter', function () {

        var location = $('#dep-loc-search').val();
        var department = $('#dep-dep-search').val();
        var checklist = $('#dep-cl-search').val();
        var datestart = $('#dep-datestart-search').val();
        var dateend = $('#dep-dateend-search').val();
        var formData = { loc: location, dep: department, cl: checklist, ds: datestart, de: dateend }

        var remoteLink = WebURL + '/reports/department/filter/show';
        $('#modal_rptdep_filter').find('.modal-body').load(remoteLink, formData, function () {
            $('#dep-datestart').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
            $('#dep-dateend').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
        });

    });

    $('body').on('click', '#modal_rptstore_filter #btn-apply-filter', function () {

        var loc = $('#store-loc').val();
        var cl = $('#store-cl').val();
        var ds = $('#store-datestart').val();
        var de = $('#store-dateend').val();
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

        $('#store-loc-search').val(loc);
        $('#store-cl-search').val(cl);
        $('#store-datestart-search').val(ds);
        $('#store-dateend-search').val(de);

        var formData = { loc: loc, cl: cl, sdf: dsfrom, sdt: dsto, edf: defrom, edt: deto };
        var remoteLink = WebURL + '/reports/location/table/show'
        $('.table-loader').show();
        $('#tbl-rpt-store').find('tbody tr').remove();
        $('#tbl-rpt-store').find('tbody').load(remoteLink, formData, function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('.table-loader').hide();
        });

    });

    $('body').on('click', '#modal_rptdep_filter #btn-apply-filter', function () {

        var loc = $('#dep-loc').val();
        var dep = $('#dep-dep').val();
        var cl = $('#dep-cl').val();
        var ds = $('#dep-datestart').val();
        var de = $('#dep-dateend').val();
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

        $('#dep-loc-search').val(loc);
        $('#dep-dep-search').val(dep);
        $('#dep-cl-search').val(cl);
        $('#dep-datestart-search').val(ds);
        $('#dep-dateend-search').val(de);

        var formData = { loc: loc, dep: dep, cl: cl, sdf: dsfrom, sdt: dsto, edf: defrom, edt: deto };
        var remoteLink = WebURL + '/reports/department/table/show'
        $('.table-loader').show();
        $('#tbl-rpt-department').find('tbody tr').remove();
        $('#tbl-rpt-department').find('tbody').load(remoteLink, formData, function () {
            $('[data-toggle="tooltip"]').tooltip();
            $('.table-loader').hide();
        });

    });

    $('body').on('click', '#btn_generate_sum', function () {

        var sqa_mr = $('#monthRange').val();
        var split_sqa_mr = sqa_mr.split(' to ');
        var sqa_mr_from = split_sqa_mr[0];
        var sqa_mr_to = split_sqa_mr[1];
        var error = false;

        if (!sqa_mr_to) {
           sqa_mr_to = sqa_mr_from;
        }

        if(sqa_mr == '') {
            var error = true;
            swal({
                title: 'Warning!',
                text: "Date range is required for generation of summary.",
                type: 'warning',
                confirmButtonText: 'Ok',
            })
        }

        if (error == false) {
            window.location = WebURL + '/export/summary/' + sqa_mr_from + '/' + sqa_mr_to;
        }
    
    });

})