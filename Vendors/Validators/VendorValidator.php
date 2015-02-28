<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *	
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Vendors\Validators;

use Validator;

class VendorValidator {

	public function getValidator($input)
	{
		return Validator::make($input, array(
			'name'  => 'required',
			'email' => 'required'
			)
		);
	}

	public function getUpdateValidator($input)
	{
		return Validator::make($input, array(
			'name'  => 'required',
			'email' => 'required'
			)
		);
	}
}