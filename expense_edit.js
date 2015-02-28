$(function() {

	$("#date").inputmask(datepickerFormat);

	$('.btn-save-expense').click(function() {
		
		$.post(expenseUpdateRoute, {
			vendor_name: $('#vendor_name').val(),
			date: $('#date').val(),
			amount: $('#amount').val(),
			note: $('#note').val()			
        }).done(function(response) {
			window.location = expenseEditRoute;
		}).fail(function(response) {
			if (response.status == 400) {
				showErrors($.parseJSON(response.responseText).errors, '#form-status-placeholder');
			} else {
				alert(unknownError);
			}
		});
	});
});