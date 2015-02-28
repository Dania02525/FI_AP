<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *	
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Expenses\Providers;

use App;
use Config;
use Event;
use Illuminate\Support\ServiceProvider;


class EventProvider extends ServiceProvider {

	/**
	 * Register the service provider
	 * @return void
	 */
	public function register() {}

	/**
	 * Bootstrap the application events
	 * @return void
	 */
	public function boot()
	{
		Event::listen('expense.created', function($expense)
		{
			$invoiceGroup = App::make('InvoiceGroupRepository');

			// Increment the next id
			$invoiceGroup->incrementNextId($expense->invoice_group_id);

		});

	}
}