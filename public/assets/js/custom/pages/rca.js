$(function () {

    $('.select2-search').select2({
        placeholder: "Select a store",
        allowClear: true
    });    
    

    $('body').on('click', '#btn-search-rca', function (e) {
        e.stopPropagation();

        var store = $('#location_search').val();

        if ($('#isSubmit').is(':checked')) {
            var isSubmit = 1;
        }
        else {
            var isSubmit = 0;
        }

        var formData = { store:store, submit:isSubmit }

        loadAuditLocationTable(formData);
    })

    $('body').on('click', '.btn-accept-audit', function (e) {
        e.stopPropagation();
        
        var id = $(this).data('id');
        var formData = { id: id };

        $.post(WebURL + '/acceptance/audit/location/accept', formData, function (data) {
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
                            loadAuditLocationTable(search)
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

})

function loadAuditLocationTable(formData) {

    $('.table-loader').show();
    $('#table_rca').find('tbody tr').remove();
    var remoteLinkTable = WebURL + '/rca/audit/location/table/show';
    $('#table_rca').find('tbody').load(remoteLinkTable, formData, function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('.table-loader').hide();
    });
}