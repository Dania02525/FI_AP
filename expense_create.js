$(function() {

    $('#create-expense').modal();

    $('#create-expense').on('shown.bs.modal', function() {
        $("#vendor_name").focus();
    });

    $("#date").inputmask(datepickerFormat);

    var vendors = new Bloodhound({
        datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.num); },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: vendorNameLookupRoute + '?query=%QUERY'
    });

    vendors.initialize();

    $('#vendor_name').typeahead(null, {
        minLength: 3,
        source: vendors.ttAdapter()
    });


    $('#expense-create-confirm').click(function() {

        $.post(storeExpenseRoute, { 
            vendor_name: $('#vendor_name').val(), 
            date: $('#date').val(),
            amount: $('#amount').val(),
            note: $('#note').val(),
            invoice_group_id: $('#create_invoice_group_id').val(),
        }).done(function(response) {
            window.location = createExpenseReturnUrl;
        }).fail(function(response) {
            if (response.status == 400) {
                showErrors($.parseJSON(response.responseText).errors, '#modal-status-placeholder');
            } else {
                alert(unknownError);
            }
        });
    });

});