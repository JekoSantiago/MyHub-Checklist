$(function () {

  $('body').on('keypress', '.option_rate, .option_ratecode, .ctg-portion-input, .item-portion-input', function (e) {
    return isNumber(e, this)
  });

  $('body').on('keyup', '.option_rate, .ctg-portion-input, .item-portion-input', function (e) {
    return twoDigits(this);
  });

  var clID = $('#checklistID').val();
  loadCategoryTree(clID);

  $('#modal_newcategory').on('show.bs.modal', function (e) {

    var parent = $(e.relatedTarget).data('id');

    if (parent == null) {
      parent = 0;
    }
    console.log(parent);

    var remoteLink = WebURL + '/maintenance/category/add/show'
    $('#modal_newcategory').find('.modal-body').load(remoteLink, function () {
      $('#parent').val(parent);
    });

  });

  $('body').on('change', '#checklist-form input, #checklist-form select', function () {

    var id = $('#checklistID').val();
    var formdata = $('#checklist-form').serialize();

    $.post(WebURL + '/checklist/update/' + id, formdata, function (data) {
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

  $('body').on('change', '#edit_category_form input', function () {

    var element = $(this).attr('id');
    var clID = $('#checklistID').val();
    var ctgID = $('#curr_ctgID').val();
    var category = $('#categoryName').val();
    var portion = $('#categoryPortion').val();

    if (portion == '') {
      portion = 0;
    }
    var formData = { clID: clID, ctgID: ctgID, category: category, portion: portion };

    $.post(WebURL + '/checklist/category/update', formData, function (data) {
      if (data.num > 0) {
        console.log(data.msg);

        if (element != $('#categoryPortion').attr('id')) {
          loadCategoryTree(clID);
        }

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

  $('body').on('change', '.item-input', function () {

    var id = $(this).data('id');
    var name = $(this).val();
    var ctgID = $('#curr_ctgID').val();
    var formdata = { itemID: id, ctgID: ctgID, name: name }

    $.post(WebURL + '/checklist/item/update', formdata, function (data) {
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

  $('body').on('change', '.input-description', function () {

    var id = $(this).data('id');
    var desc = $(this).val();
    var formdata = { itemID: id, desc: desc }

    $.post(WebURL + '/checklist/item/description/update', formdata, function (data) {
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

  $('body').on('change', '.item-portion-input', function () {

    var id = $(this).data('id');
    var portion = $(this).val();

    if (portion == '') {
      portion = 0;
    }
    var formdata = { itemID: id, portion: portion }

    $.post(WebURL + '/checklist/item/portion/update', formdata, function (data) {
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

  $('body').on('change', '.item_form select', function () {

    var id = $(this).data('id');
    var type = $(this).val();
    var cl = $('#checklistID').val();
    var ctg = $('#curr_ctgID').val();
    var formdata = { id: id, type: type }
    var loadItemData = { ctg: ctg, cl: cl };

    $.post(WebURL + '/checklist/item/type/update', formdata, function (data) {
      if (data.num > 0) {
        console.log(data.msg);

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/maintenance/checklist/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, loadItemData, function () {
          $('[data-toggle="tooltip"]').tooltip();
          $('.cover-spin-content').hide();
          $('.card.card-click').removeClass('active');
          $('.card-' + data.num).addClass('active');
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
  });

  $('body').on('change', '.option_name', function () {

    var id = $(this).data('id');
    var option = $(this).val();
    var formdata = { id: id, option: option }

    $.post(WebURL + '/checklist/option/update', formdata, function (data) {
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

  $('body').on('change', '.option_rate', function () {

    var id = $(this).data('id');
    var rate = $(this).val();

    if (rate == '') {
      rate = 0;
    }

    var formdata = { id: id, rate: rate }

    $.post(WebURL + '/checklist/option/rate/update', formdata, function (data) {
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

  $('body').on('change', '.option_ratecode', function () {

    var id = $(this).data('id');
    var rate = $(this).val();

    var formdata = { id: id, rate: rate }

    $.post(WebURL + '/checklist/option/ratecode/update', formdata, function (data) {
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

  $('body').on('click', '.opt_remove', function () {

    var optionID = $(this).data('id');
    var itemID = $(this).data('item');
    var cl = $('#checklistID').val();
    var ctg = $('#curr_ctgID').val();
    var loadItemData = { ctg: ctg, cl: cl };

    $.post(WebURL + '/checklist/option/delete', { id: optionID }, function (data) {
      if (data.num > 0) {
        console.log(data.msg);

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/maintenance/checklist/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, loadItemData, function () {
          $('[data-toggle="tooltip"]').tooltip();
          $('.cover-spin-content').hide();
          $('.card-' + itemID).addClass('active');
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

  });

  $('body').on('click', '.remove_item', function () {

    var itemID = $(this).data('id');
    var isDeleted = 1;
    var cl = $('#checklistID').val();
    var ctg = $('#curr_ctgID').val();
    var idFocus = $('.card-' + itemID).prev().data('id');
    var loadItemData = { ctg: ctg, cl: cl };
    $('.item-delete-success').hide();
    $('#del_itemID').val(itemID);

    $.post(WebURL + '/checklist/item/delete', { id: itemID, bool: isDeleted }, function (data) {
      if (data.num > 0) {
        console.log(data.msg);

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/maintenance/checklist/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, loadItemData, function () {
          $('[data-toggle="tooltip"]').tooltip();
          $('.cover-spin-content').hide();
          clearFunction();
          showUndoAlert();
          $('.card-' + idFocus).addClass('active');
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

  });

  $('body').on('click', '.undo-delete', function () {

    var itemID = $('#del_itemID').val();
    var isDeleted = 0;
    var cl = $('#checklistID').val();
    var ctg = $('#curr_ctgID').val();
    var loadItemData = { ctg: ctg, cl: cl };

    $.post(WebURL + '/checklist/item/delete', { id: itemID, bool: isDeleted }, function (data) {
      if (data.num > 0) {
        console.log(data.msg);

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/maintenance/checklist/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, loadItemData, function () {
          $('[data-toggle="tooltip"]').tooltip();
          $('.cover-spin-content').hide();
          $('.item-delete-success').hide();
          $('.card-' + data.num).addClass('active');
          $("#quest_" + data.num).focus();
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

  });

  $('body').on('click', '.duplicate_item', function () {

    var itemID = $(this).data('id');
    var cl = $('#checklistID').val();
    var ctg = $('#curr_ctgID').val();
    var loadItemData = { ctg: ctg, cl: cl };
    $('.item-delete-success').hide();

    $.post(WebURL + '/checklist/item/duplicate', { id: itemID, ctg: ctg }, function (data) {
      if (data.num > 0) {
        console.log(data.msg);

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/maintenance/checklist/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, loadItemData, function () {
          $('[data-toggle="tooltip"]').tooltip();
          $('.cover-spin-content').hide();
          $('.card-' + data.num).addClass('active');
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

  });

  $('body').on('click', '.addOption', function () {

    var item_ID = $(this).data('id');
    var cl = $('#checklistID').val();
    var ctg = $('#curr_ctgID').val();
    var loadItemData = { ctg: ctg, cl: cl };

    $.post(WebURL + '/checklist/option/add', { id: item_ID }, function (data) {
      if (data.num > 0) {
        console.log(data.msg);

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/maintenance/checklist/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, loadItemData, function () {
          $('[data-toggle="tooltip"]').tooltip();
          $('.cover-spin-content').hide();
          $('.card.card-click').removeClass('active');
          $('.card-' + item_ID).addClass('active');
          $('#option_' + data.num).focus();
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

  });

  $('body').on('click', '.require-switch', function () {

    var id = $(this).data('id');
    var isChecked = $(this).prop('checked');

    if (isChecked) {
      var require = 1;
    } else {
      var require = 0;
    }

    var formdata = { id: id, require: require };

    $.post(WebURL + '/checklist/item/require', formdata, function (data) {
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

  $('body').on('click', '#btn-save-ctg', function () {

    var error = false;
    var id = $('#checklistID').val();
    var category = $('#category').val();
    var parent = $('#parent').val();
    var formdata = { id: id, ctg: category, parent: parent };

    if (category.length == 0) {
      var error = true;
      $('#newcategoryerror').show();
    } else {
      $('#newcategoryerror').hide();
    }

    if (error == false) {

      $.post(WebURL + '/checklist/category/add', formdata, function (data) {
        if (data.num > 0) {
          console.log(data.msg);
          loadCategoryTree(id);
          $('#modal_newcategory').modal('toggle');
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

  $('body').on('click', '.remove-category', function () {

    var id = $(this).data('id');
    var clID = $('#checklistID').val();
    var curctgID = $('#curr_ctgID').val();


    swal({
      title: "Are you sure?",
      text: "You're about to delete a category.",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#ffcc00",
      confirmButtonText: "Yes",
      cancelButtonText: "Cancel",
      closeOnConfirm: true,
    },
      function (isConfirm) {
        if (isConfirm) {
          $.post(WebURL + '/checklist/category/delete', { id: id }, function (data) {
            if (data.num > 0) {
              console.log(data.msg);
              loadCategoryTree(clID);

              if (curctgID == id) {
                $('.cover-spin-content').show();
                var remoteLink = WebURL + '/maintenance/question/show';
                $('.checklist-container').find('.checklist-body').load(remoteLink, { ctg: 0, cl: clID }, function () {
                  $(window).scrollTop(0);
                  $('[data-toggle="tooltip"]').tooltip();
                  $('.cover-spin-content').hide();
                  $('.add-question').removeClass('disabled');
                });
              }

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

  });

  $('body').on('click', '.ctg-link', function () {

    var ctgID = $(this).data('id');
    var clID = $('#checklistID').val();
    $('#curr_ctgID').val(ctgID);

    var formData = { ctg: ctgID, cl: clID }

    console.log(ctgID);
    console.log(clID);

    if ($('body').hasClass('mobile-view')) {
      $('body').toggleClass('category-nav-collapse');
    }


    $('.cover-spin-content').show();
    var remoteLink = WebURL + '/maintenance/checklist/question/show';
    $('.checklist-container').find('.checklist-body').load(remoteLink, formData, function () {
      $(window).scrollTop(0);
      $('.parent-category > span').removeClass('active');
      $('.span-' + ctgID).addClass('active');

      $('.cover-spin-content').hide();
      $('.add-question').removeClass('disabled');
    });
  });

  $('body').on('click', '.add-question', function () {

    var ctgID = $('#curr_ctgID').val();
    var clID = $('#checklistID').val();

    var loadItemData = { ctg: ctgID, cl: clID };
    var addItemData = { ctg: ctgID };

    $.post(WebURL + '/checklist/item/add', addItemData, function (data) {
      if (data.num > 0) {
        console.log(data.msg);

        $('.cover-spin-content').show();
        var remoteLink = WebURL + '/maintenance/checklist/question/show';
        $('.checklist-container').find('.checklist-body').load(remoteLink, loadItemData, function () {
          $('[data-toggle="tooltip"]').tooltip();
          $('.cover-spin-content').hide();
          $('.card.card-click').removeClass('active');
          $("#quest_" + data.num).parents('div.card').addClass('active');
          $("#quest_" + data.num).focus();
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

  });

})

var time;

function removeActive() {
  time = setTimeout(function () {
    $('.ctg-menu').removeClass('show');
  }, 500);
}

function showUndoAlert() {

  $('.item-delete-success').removeClass('flipOutX');
  $('.item-delete-success').show();

  time = setTimeout(function () {
    $('.item-delete-success').addClass('flipOutX');
  }, 10000)
}

function clearFunction() {
  clearTimeout(time);
}

function loadCategoryTree(clID) {
  var remoteLink = WebURL + '/maintenance/checklist/category/show/' + clID;
  $('.cover-spin-sidenav').show();
  $('.category-nav').find('.sidenav-body').load(remoteLink, function () {

    $('[data-toggle="tooltip"]').tooltip();

    var mouse = false;
    $('.cover-spin-sidenav').hide();

    $('.parent-category span').mouseover(function (e) {

      clearFunction();
      $('.ctg-menu').removeClass('show');
      $(this).next().addClass('show');

    }).mouseout(function (e) {

      removeActive(mouse);
    });
  });
}

function isNumber(evt, element) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (
    (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
    (charCode < 48 || charCode > 57))
    return false;
  return true;
}

function twoDigits(element) {
  if ($(element).val().indexOf('.') != -1) {
    if ($(element).val().split(".")[1].length > 3) {
      if (isNaN(parseFloat(element.value))) return;
      element.value = parseFloat(element.value).toFixed(3);
    }
  }

  return element;
}

