$(function () {

    $('body').on('show.bs.modal', '#modal_approval_filter', function () {

        var location = $('#loc-search').val();
        var status = $('#status-search').val();
        var datestart = $('#datestart-search').val();
        var dateapp = $('#dateapp-search').val();
        var formData = { loc: location, status: status, ds: datestart, da: dateapp }

        var remoteLink = WebURL + '/approval/audit/location/filter/show';
        $('#modal_approval_filter').find('.modal-body').load(remoteLink, formData, function () {
            $('#datestart').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
            $('#dateapp').flatpickr({
                mode: 'range',
                dateFormat: 'Y-m-d'
            });
        });

    });

    $('body').on('click', '#modal_approval_filter #btn-apply-filter', function () {

        var loc = $('#location').val();
        var status = $('#status').val();
        var ds = $('#datestart').val();
        var da = $('#dateapp').val();
        var splitds = ds.split(' to ');
        var splitda = da.split(' to ');
        var dsfrom = splitds[0];
        var dsto = splitds[1];
        var dafrom = splitda[0];
        var dato = splitda[1];

        if (!dsto) {
            dsto = dsfrom;
        }

        if (!dato) {
            dato = dafrom;
        }

        $('#loc-search').val(loc);
        $('#status-search').val(status);
        $('#datestart-search').val(ds);
        $('#dateapp-search').val(da);

        var formData = { loc: loc, status: status, dsf: dsfrom, dst: dsto, daf: dafrom, dat: dato };
        console.log(formData)
        loadApprovalTable(formData);

    });

    $('body').on('click', '#modal_approval_filter #btn-reset-filter', function () {
        $('#location').val(0).change();
        $('#status').val(0).change();
        $('#datestart').val('');
        $('#dateapp').val('');
    })

})

function loadApprovalTable(formData) {

    $('.table-loader').show();
    $('#table_approval').find('tbody tr').remove();
    var remoteLinkTable = WebURL + '/approval/audit/location/table/show';
    $('#table_approval').find('tbody').load(remoteLinkTable, formData, function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('.table-loader').hide();
    });
}