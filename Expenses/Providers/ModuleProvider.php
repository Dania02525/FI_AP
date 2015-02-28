<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *  
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Expenses\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider {

	public function register()
	{
        $this->app->register('FI\Modules\Expenses\Providers\EventProvider');

		$this->app->bind('ExpenseRepository', 'FI\Modules\Expenses\Repositories\ExpenseRepository');
		$this->app->bind('ExpenseValidator', 'FI\Modules\Expenses\Validators\ExpenseValidator');
		$this->app->bind('ExpenseController', function($app)
        {
            return new \FI\Modules\Expenses\Controllers\ExpenseController( 
                $app->make('InvoiceGroupRepository'),          
                $app->make('ExpenseRepository'),
                $app->make('ExpenseValidator')
            );
        });
    }
}