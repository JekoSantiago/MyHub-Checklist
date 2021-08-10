$(function () {

    var search = '';
    loadAuditLocationTable(search);

    $('body').on('click', '.btn-accept-audit', function (e) {
        e.stopPropagation();
        
        var id = $(this).data('id');
        var formData = { id: id };

        swal(
            {
                title: "Are you sure?",
                text: "Accept this audit.",
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
                }
            }
        );


    })

})

function loadAuditLocationTable(search) {

    formData = { search: search };

    $('.table-loader').show();
    $('#table_acceptance').find('tbody tr').remove();
    var remoteLinkTable = WebURL + '/acceptance/audit/location/table/show';
    $('#table_acceptance').find('tbody').load(remoteLinkTable, formData, function () {
        $('[data-toggle="tooltip"]').tooltip();
        $('.table-loader').hide();
    });
}