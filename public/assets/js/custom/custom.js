$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(window).on('load', function () {

    });

    $(document).ready(function () {
        $('body').removeClass('preload');
    });

    $('body').on('click', '.button-toggle-main-sb', function (e) {
        e.preventDefault();
        $('body').toggleClass('slide-out');
    });

    $('body').on('click', '.side-bar-backdrop', function (e) {
        e.preventDefault();
        $('body').toggleClass('slide-out');
    });

    $('#userMenu').on('show.bs.collapse', function () {
        $('.user-navigation').addClass('active');
    })

    $('#userMenu').on('hide.bs.collapse', function () {
        $('.user-navigation').removeClass('active');
    })

    $('#auditMenu').on('show.bs.collapse', function () {
        $('.new-audit').addClass('active');
    })

    $('#auditMenu').on('hide.bs.collapse', function () {
        $('.new-audit').removeClass('active');
    })

    if (document.documentElement.clientWidth <= 1024) {
        $('body').addClass('mobile-view');
        $('body').addClass('category-nav-collapse');
    }
    else {
        $('body').removeClass('mobile-view');
    }

    if(!$('body').hasClass('single_category')) {
        window.addEventListener("resize", function () {
            if (document.documentElement.clientWidth <= 1024) {
                $('body').addClass('category-nav-collapse');
            }
            else {
                $('body').removeClass('category-nav-collapse');
            }
        });   
    } 

    window.addEventListener("resize", function () {
        if (document.documentElement.clientWidth <= 1024) {
            $('body').addClass('mobile-view');
        }
        else {
            $('body').removeClass('mobile-view');
        }
    });  

    $('body').on('click', '.btn-toggle-ctg', function () {
        $('body').toggleClass('category-nav-collapse');
    });

    $('body').on('click', '.category-nav-backdrop', function () {
        $('body').toggleClass('category-nav-collapse');
    });

    $('body').on('click', '.card.card-click', function () {

        var item_ID = $(this).data('id');

        if ($(this).hasClass('active') == false) {

            $('.card.card-click').removeClass('active');
            $(this).addClass('active');
        }

    });

    $('body').on('click', '.category-nav li.parent-category > span > i.toggle-tree', function (e) {

        var children = $(this).parent('span').parent('li.parent-category').find(' > ul > li');
        if (children.is(":visible")) {
            children.hide('');
            $(this).addClass('fa-plus-square').removeClass('fa-minus-square');
        } else {
            children.show('');
            $(this).addClass('fa-minus-square').removeClass('fa-plus-square');
        }

        e.stopPropagation();
    });

    $('#modal_answer_cl').on('show.bs.modal', function (e) {

        $('#answer_checklist_search').val('');
        var search = $('#answer_checklist_search').val();

        loadActiveChecklistTable(search)

    });

    $('body').on('click', '#btn-search-answercl', function (e) {

        var search = $('#answer_checklist_search').val();

        loadActiveChecklistTable(search)
    });

    $('body').on('click', '.answer-regular tbody tr.row-click', function (e) {
        e.stopPropagation();

        var clid = $(this).data('clid');
        var formData = { id: clid };

        $.post(WebURL + '/answer/start', formData, function (data) {
            if (data.num > 0) {
                console.log(data.msg);

                window.location = WebURL + '/answer/' + btoa(data.num);
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

function loadActiveChecklistTable(search) {

    formData = { search: search };

    $('.modal-table-loader').show();
    $('.answer-regular').find('tbody tr').remove();
    var remoteLink = WebURL + '/answer/active/checklist/table/show'
    $('.answer-regular').find('tbody').load(remoteLink, formData, function () {
        $('.modal-table-loader').hide();
    });
}