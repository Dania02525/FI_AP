<?php

Route::group(array('before' => 'auth'), function()
{
	Route::get('expenses', array('uses' => 'ExpenseController@index', 'as' => 'expenses.index'));
	Route::get('expenses/modal/create', array('uses' => 'ExpenseController@modalCreate', 'as' => 'expenses.ajax.modalCreate'));
	Route::get('expenses/{expense}/edit', array('uses' => 'ExpenseController@edit', 'as' => 'expenses.edit'));
	Route::get('expenses/{expense}/delete', array('uses' => 'ExpenseController@delete', 'as' => 'expenses.delete'));
	Route::post('expenses/create', array('uses' => 'ExpenseController@store', 'as' => 'expenses.store'));
	Route::post('expenses/{expense}/edit', array('uses' => 'ExpenseController@update', 'as' => 'expenses.update'));
});