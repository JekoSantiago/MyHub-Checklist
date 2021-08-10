$(function () {

    $('body').on('click', '#end_audit', function (e) {

        var auditID = $('#audit_ID').val();
        var monitoring_required = $('#monitoring_total_required').val();
        var monitoring_answered = $('#monitoring_total_answer').val();
        var focus_required = $('#focus_total_required').val();
        var focus_answered = $('#focus_total_answer').val();
        var rca_findings = $('#rca_findings').val();
        var error = false;

        var formData = { id: auditID };

        if (parseInt(monitoring_required) > parseInt(monitoring_answered)) {
            var error = true;
        }

        if (parseInt(focus_required) > parseInt(focus_answered)) {
            var error = true;
        }

        if (parseInt(rca_findings) < 1) {
            var error = true;
        }

        if(error == false)
        {
            swal({
                title: "Are you sure?",
                text: "You are about to end your audit for this store",
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
                        $.post(WebURL + '/audit/location/submit', formData, function (data) {
                            if (data.num > 0) {
                                console.log(data.msg);
    
                                swal({
                                    title: "Success",
                                    text: data.msg,
                                    confirmButtonColor: "#2E7D32",
                                    type: "success"
                                },
                                function(isConfirm){
                                    if (isConfirm) {
                                        window.location = WebURL + '/myaudit';
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
                title: "Error!",
                text: "Please accomplish all required audit checklists.",
                confirmButtonColor: "#2E7D32",
                type: "error"
            });
        }

    });

    $('body').on('change', '#audit_remarks', function (e) {
        e.stopPropagation();

        var auditID = $('#audit_ID').val();
        var remarks = $(this).val();
        var formData = { id: auditID, remarks: remarks };

        $.post(WebURL + '/audit/location/remarks/update', formData, function (data) {
            if (data.num > 0) {
                console.log(data.msg);
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