<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *  
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Vendors\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind('VendorRepository', 'FI\Modules\Vendors\Repositories\VendorRepository');
		$this->app->bind('VendorValidator', 'FI\Modules\Vendors\Validators\VendorValidator');
		$this->app->bind('VendorController', function($app)
        {
            return new \FI\Modules\Vendors\Controllers\VendorController(           
                $app->make('VendorRepository'),
                $app->make('VendorValidator')
            );
        });
    }
}