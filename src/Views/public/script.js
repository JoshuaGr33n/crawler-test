// ##################### Import Schedule via CSV #######
$(document).ready(function () {
    $('#import').change(function () {
        $('#import_schedule_Form').submit();
    });
    $('#import_schedule_Form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "docs/import-schedule-process.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function (data) {
                $('#wrapper').html(data);
                $('#import').val('');
                $(".btn-close").trigger("click");
            }
        });
    });
});


// ##################### Hide/Show delete button #######
$(".answer").hide();

function check() {
    if ($('.checkRow').is(":checked"))
        $(".answer").show();
    else
        $(".answer").hide();
}


// ##################### Check all checkboxes #######
$("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
    if ($('.checkRow').is(":checked"))
        $(".answer").show();
    else
        $(".answer").hide();
});




// ##################### Add Row #######
$(document).ready(function () {
    $("#add_row_Form").on('submit', function (ev) {
        ev.preventDefault();
        // $submitButton = $('input#add_row_submit'),
        //   submitButtonText = $submitButton.val();
        // $submitButton.val($submitButton.data('loading-text') ? $submitButton.data('loading-text') : 'Please wait...').attr('disabled', true);
        $.ajax({
            url: "docs/add-row-process.php",
            type: "POST",
            data: new FormData($("#add_row_Form")[0]),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status === 1) {
                    document.getElementById('add_row_Form').reset();
                    $(".btn-close").trigger("click");

                    var resp = '<tr class="3 mb-2 bg-success text-white"">' +
                        '<td>' +
                        '' +
                        '</td>' +
                        '<td data-label="Date">' + data.date + '</td>' +
                        '<td data-label="NO">' + data.outline_number + '</td>' +
                        '<td data-label="THEME">' + data.theme + '</td>' +
                        '<td data-label="SPEAKER">' + data.speaker + '</td>' +
                        '<td data-label="CHAIRMAN">' + data.chairman + '</td>' +
                        '<td data-label="">' +
                        '' +
                        '</td>' +
                        '<td data-label="">' +
                        '' +
                        '</td>' +
                        '</tr>';
                    $("tbody").prepend(resp);
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 3000);
                    sendSuccessResponse('Success', data.message);


                } else if (data.status === 5) {
                    $("#err-exist").html('' +
                        '<div class="alert alert-danger alert-dismissible" role="alert">' + data.message + '</div>'
                    );

                } else if (data.status === 6) {
                    $("#err-number").html('' +
                        '<div class="alert alert-danger alert-dismissible" role="alert">' + data.message + '</div>'
                    );

                } else if (data.status === 7) {
                    $("#err-date-format").html('' +
                        '<div class="alert alert-danger alert-dismissible" role="alert">' + data.message + '</div>'
                    );

                } else if (data.status === 8) {
                    $("#err-file").html('' +
                        '<div class="alert alert-danger alert-dismissible" role="alert">' + data.message + '</div>'
                    );

                } else {
                    sendErrorResponse('Error', data.message);
                    $.alert({
                        title: 'Error!',
                        content: data.message,
                        type: 'red',
                        typeAnimated: true,
                    });
                }
            },
            error: function (errData) { },
            complete: function () {
                // $submitButton.val(submitButtonText).attr('disabled', false);
            }
        });
    });
});




// ##################### Edit Row #######
$(document).ready(function () {
    $('.edit-row-submit').click(function (ev) {
        ev.preventDefault();
        var id = $(this).data('id');
        // $submitButton = $('input#edit_row_submit'),
        //   submitButtonText = $submitButton.val();
        // $submitButton.val($submitButton.data('loading-text') ? $submitButton.data('loading-text') : 'Please wait...').attr('disabled', true);
        $.ajax({
            url: "docs/edit-row-process.php",
            type: "POST",
            data: new FormData($("#edit_row_Modal" + id + " #edit_row_Form")[0]),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status === 1) {
                    $(".btn-close").trigger("click");

                    var resp = '<tr class="3 mb-2 bg-success text-white"">' +
                        '<td>' +
                        '' +
                        '</td>' +
                        '<td data-label="Date">' + data.date + '</td>' +
                        '<td data-label="NO">' + data.outline_number + '</td>' +
                        '<td data-label="THEME">' + data.theme + '</td>' +
                        '<td data-label="SPEAKER">' + data.speaker + '</td>' +
                        '<td data-label="CHAIRMAN">' + data.chairman + '</td>' +
                        '<td data-label="">' +
                        '' +
                        '</td>' +
                        '<td data-label="">' +
                        '' +
                        '</td>' +
                        '</tr>';
                    $("tbody").prepend(resp);
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 3000);
                    sendSuccessResponse('Success', data.message);


                } else if (data.status === 5) {
                    $("#err-exist-edit" + id).html('' +
                        '<div class="alert alert-danger alert-dismissible" role="alert">' + data.message + '</div>'
                    );

                } else if (data.status === 6) {
                    $("#err-number" + id).html('' +
                        '<div class="alert alert-danger alert-dismissible" role="alert">' + data.message + '</div>'
                    );

                } else if (data.status === 7) {
                    $("#err-date-format-edit-" + id).html('' +
                        '<div class="alert alert-danger alert-dismissible" role="alert">' + data.message + '</div>'
                    );

                } else if (data.status === 8) {
                    $("#err-file-edit-" + id).html('' +
                        '<div class="alert alert-danger alert-dismissible" role="alert">' + data.message + '</div>'
                    );

                } else {


                    // $("#err-date-format-edit" + id).html('' +
                    //   '<div class="alert alert-danger alert-dismissible" role="alert">' + data.message + '</div>'
                    // );

                    sendErrorResponse('Error', data.message);
                    $.alert({
                        title: 'Error!',
                        content: data.message,
                        type: 'red',
                        typeAnimated: true,
                    });
                }
            },
            error: function (errData) { },
            complete: function () {
                // $submitButton.val(submitButtonText).attr('disabled', false);
            }
        });
    });
});


function sendSuccessResponse(head, body) {
    $("#response-alert").html('' +
        '<div class="alert alert-success alert-dismissible" role="alert">' +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
        '<strong><i class="far fa-thumbs-up"></i> ' + head + '!</strong> ' + body + '</div>'
    );
    new PNotify({
        title: head + '!',
        text: body,
        type: 'success'
    });
}

function sendErrorResponse(head, body) {
    $("#response-alert").html('' +
        '<div class="alert alert-danger alert-dismissible" role="alert">' +
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
        '<strong><i class="fas fa-exclamation-triangle"></i> ' + head + '!</strong> ' + body + '</div>'
    );
    new PNotify({
        title: head + '!',
        text: body,
        type: 'error'
    });
}



// ##################### Delete Row(s) #######
$(document).ready(function () {

    // Delete 
    $('.delete').click(function () {
        // var el = this;

        var checked = [];
        $("tbody tr input[name='row[]']:checked").each(function () {
            checked.push(parseInt($(this).val()));
        });
        $.confirm({
            title: 'Delete',
            content: 'Are you sure you want to delete this row?',
            buttons: {
                Yes: {
                    text: 'Yes',
                    btnClass: 'btn-danger',
                    action: function () {
                        // AJAX Request
                        $.ajax({
                            url: 'docs/delete-row-process.php',
                            type: 'POST',
                            data: {
                                row: checked
                            },
                            success: function (response) {

                                if (response == 1) {
                                    // Remove row from Table
                                    $(".delete-row").closest('tr').css('background', 'red');
                                    $(".delete-row").closest('tr').fadeOut(800, function () {
                                        $(this).remove();
                                    });
                                } else {
                                    alert('Invalid Selection.');
                                }

                            }

                        });
                        setInterval('location.reload()', 1000);
                    }
                },
                cancel: function () {

                }
            }
        });

    });

});
