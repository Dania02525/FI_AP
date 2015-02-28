<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::group(array('before' => 'auth'), function()
{
	Route::get('vendors', array('uses' => 'VendorController@index', 'as' => 'vendors.index'));
	Route::get('vendors/create', array('uses' => 'VendorController@create', 'as' => 'vendors.create'));
	Route::get('vendors/{vendor}/edit', array('uses' => 'VendorController@edit', 'as' => 'vendors.edit'));
	Route::get('vendors/{vendor}', array('uses' => 'VendorController@show', 'as' => 'vendors.show'));
	Route::get('vendors/{vendor}/delete', array('uses' => 'VendorController@delete', 'as' => 'vendors.delete'));
	Route::get('vendors/ajax/name_lookup', array('uses' => 'VendorController@ajaxNameLookup', 'as' => 'vendors.ajax.nameLookup'));
	
	Route::post('vendors/create', array('uses' => 'VendorController@store', 'as' => 'vendors.store'));
	Route::post('vendors/{vendor}/edit', array('uses' => 'VendorController@update', 'as' => 'vendors.update'));
});