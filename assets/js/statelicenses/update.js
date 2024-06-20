var api_url = $('meta[name="api-url"]').attr('content');
var apitoken = $('meta[name="apitoken"]').attr('content');
var id_matter = "";

if ($('#id_matter').length > 0) {
    id_matter = $('#id_matter').val();
}

function countObjectKeys(obj) {
    return Object.keys(obj).length;
}

var set_date_format = 'MM/DD/YYYY';

$(document).ready(function() {
    $("#country,#p_country").select2({
        theme: 'bootstrap4',
        allowClear: false,
        ajax: {
            type: "POST",
            url: api_url + "countries/select_list.php",
            headers: {
                'apitoken': apitoken
            },
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term, // search term
                    page_no: params.page,
                    page_limit: 10
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.data,
                    pagination: {
                        more: params.page < data.total_page
                    }
                };
            },
            cache: true
        }
    });

    $("#state").select2({
        theme: 'bootstrap4',
        allowClear: false,
        ajax: {
            type: "POST",
            url: api_url + "states/select_list.php",
            headers: {
                'apitoken': apitoken
            },
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    search: params.term, // search term
                    page_no: params.page,
                    page_limit: 10
                };
            },
            processResults: function(data, params) {
                params.page = params.page || 1;
                return {
                    results: data.data,
                    pagination: {
                        more: params.page < data.total_page
                    }
                };
            },
            cache: true
        }
    });
});

$(function() {
    var state_licenses_id = $("#id").val();
    editContact(state_licenses_id);

    // Add new
    $.validator.setDefaults({
        submitHandler: function() {
            var form = $("#state_licenses_form");
            $('#statelicenses_submit').attr('disabled', true);
            $.ajax({
                type: "POST",
                url: api_url + "state_licenses/update.php",
                headers: {
                    'apitoken': apitoken
                },
                data: {
                    id: $('#id').val(),
                    state: $("#state").val(),
                    description: $("#description").val(),
                    ce_completion_status: $("#ce_completion_status").val(),
                    license_start_date: $("#license_start_date").val(),
                    license_end_date: $("#license_end_date").val(),
                    first_renewal: $("#first_renewal").val(),
                    ce_broker: $("#ce_broker").val(),
                    issue_date: $("#issue_date").val(),
                    expiration_date: $("#expiration_date").val(),
                    last_updated_date: $("#last_updated_date").val(),
                    receipt_amount: $("#receipt_amount").val(),
                    document_type: $("#document_type").val(),
                    doc_date: $("#doc_date").val(),
                    doc_exp_date: $("#doc_exp_date").val(),
                    doc_last_updated: $("#doc_last_updated").val(),
                    note: $("#note").val(),
                    note_date: $("#note_date").val(),
                    followup_type: $("#followup_type").val(),
                    note_exp_date: $("#note_exp_date").val(),
                    note_last_updated: $("#note_last_updated").val(),
                    note_issue_date: $("#note_issue_date").val()
                },
                success: function(data) {
                    console.log(data);
                    if (data.code) {
                        $(document).Toasts('create', {
                            class: 'bg-success',
                            title: 'Success',
                            autohide: true,
                            delay: 5000,
                            body: 'State license updated successfully.'
                        });
                        window.location.href = 'index.php?pid=state_licenses_list';
                        reset_state_licenses_form();
                        $('#statelicenses_submit').attr('disabled', false);
                    } else {
                        var errors = data.errors;
                        if (countObjectKeys(errors)) {
                            $.each(errors, function(index, value) {
                                $(document).Toasts('create', {
                                    class: 'bg-danger',
                                    title: 'Failure',
                                    autohide: true,
                                    delay: 5000,
                                    body: value
                                });
                            });
                        } else {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Failure',
                                autohide: true,
                                delay: 5000,
                                body: data.message
                            });
                        }
                        reload_state_licenses_table();
                        $('#statelicenses_submit').attr('disabled', false);
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log(XMLHttpRequest);
                    console.log("Error: " + errorThrown);
                }
            });
        }
    });

    // Custom validation code can go here if needed
});

$("select").on("select2:close", function(e) {
    $(this).valid();
});

function editContact(id) {
    $(".loading-overlay").addClass("active");
    $.ajax({
        type: "GET",
        url: api_url + "state_licenses/detail.php",
        headers: {
            'apitoken': apitoken
        },
        data: {
            id: id
        },
        success: function(data) {
            $(".loading-overlay").removeClass("active");
            if (data.code) {
                var rowdata = data.data;
                $("#state").val(rowdata.state);
                $("#provider_id").val(rowdata.provider_id);
                $("#license_type").val(rowdata.license_type);
                $("#license_number").val(rowdata.license_number);
                $("#issue_date").val(rowdata.issue_date);
                $("#exp_date").val(rowdata.exp_date);
                $("#last_updated").val(rowdata.last_updated);
                $("#suppervising_physician").val(rowdata.suppervising_physician);
                $("#practitioners_in_cpa").val(rowdata.practitioners_in_cpa);
                $("#renewal_id_pin").val(rowdata.renewal_id_pin);
                $("#primary_check").val(rowdata.primary_check);
                $("#compact").val(rowdata.compact);
                $("#collaborative_relationship").val(rowdata.collaborative_relationship);
                $("#enrolled_in_pmp").val(rowdata.enrolled_in_pmp);
                $("#receipt_amount").val(rowdata.receipt_amount);
                $("#document_type").val(rowdata.document_type);
                $("#doc_date").val(rowdata.doc_date);
                $("#doc_exp_date").val(rowdata.doc_exp_date);
                $("#doc_last_updated").val(rowdata.doc_last_updated);
                $("#note").val(rowdata.note);
                $("#note_date").val(rowdata.note_date);
                $("#followup_type").val(rowdata.followup_type);
                $("#note_exp_date").val(rowdata.note_exp_date);
                $("#note_last_updated").val(rowdata.note_last_updated);
                $("#note_issue_date").val(rowdata.note_issue_date);
            } else {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Failure',
                    autohide: true,
                    delay: 5000,
                    body: data.message
                });
            }
        },
        statusCode: {
            401: function() {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Failure',
                    autohide: true,
                    delay: 5000,
                    body: "Your login is expired. Please login again."
                });
                setTimeout(function() {
                    window.location.href = "logout";
                }, 3000);
            }
        }
    });
}

function reset_state_licenses_form() {
    $("#state").val("");
    $("#provider_id").val("");
    $("#license_type").val("");
    $("#license_number").val("");
    $("#issue_date").val("");
    $("#exp_date").val("");
    $("#last_updated").val("");
    $("#suppervising_physician").val("");
    $("#practitioners_in_cpa").val("");
    $("#renewal_id_pin").val("");
    $("#primary_check").val("");
    $("#compact").val("");
    $("#collaborative_relationship").val("");
    $("#enrolled_in_pmp").val("");
    $("#receipt_amount").val("");
    $("#document_type").val("");
    $("#doc_date").val("");
    $("#doc_exp_date").val("");
    $("#doc_last_updated").val("");
    $("#note").val("");
    $("#note_date").val("");
    $("#note_issue_date").val("");
    $("#followup_type").val("");
    $("#note_exp_date").val("");
    $("#note_last_updated").trigger("reset");
}
