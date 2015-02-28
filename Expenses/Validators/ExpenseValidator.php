<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *	
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Expenses\Validators;

use Validator;

class ExpenseValidator {

	public function getValidator($input)
	{
		return Validator::make($input, array(
			'vendor_name' => 'required',
			'date'    	  => 'required|date',
			'amount'  	  => 'required|numeric'
			)
		);
	}

	public function getUpdateValidator($input)
	{
		return Validator::make($input, array(
			'vendor_name' => 'required',
			'date'    	  => 'required|date',
			'amount'  	  => 'required|numeric'
			)
		);
	}
}