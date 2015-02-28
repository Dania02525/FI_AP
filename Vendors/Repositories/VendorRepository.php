<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *	
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Vendors\Repositories;

use App;
use Config;
use DB;
use FI\Modules\Vendors\Models\Vendor;

class VendorRepository extends \FI\Libraries\BaseRepository {

	public function __construct(Vendor $model)
	{
		$this->model = $model;
	}

	public function create($input)
	{
		$vendor = $this->model->create($input);

		return $vendor;
	}

	public function getPaged($filter = null) 
	{
		$vendor =  $this->model->orderBy('name');

		if ($filter)
		{
			$vendor->keywords($filter);
		}

		return $vendor->paginate(Config::get('fi.defaultNumPerPage'));
	}

	/**
	 * Provides a json encoded array of matching vendor names
	 * @param  string $name
	 * @return json
	 */
	public function lookupByName($name)
	{
		$vendors = $this->model->select('name')
		->orderBy('name')
		->where('name', 'like', '%' . $name . '%')
		->get();

		$return = array();

		foreach ($vendors as $vendor)
		{
			$return[]['value'] = $vendor->name;
		}

		return json_encode($return);
	}

	/**
	 * Return vendor ID queried by name
	 * @param  string $name
	 * @return mixed
	 */
	public function findIdByName($name)
	{
		if ($vendor = $this->model->select('id')->where('name', $name)->first())
		{
			return $vendor->id;
		}

		return null;
	}

	public function firstOrCreate($name)
	{
		return $this->model->firstOrCreate(array('name' => $name));
	}

	/**
	 * Update a record
	 * @param  array $input
	 * @param  int $id
	 * @return Vendor
	 */
	public function update($input, $id)
	{
		$vendor = $this->model->find($id);

		$vendor->fill($input);

		$vendor->save();

		return $vendor;
	}

	/**
	 * Delete a record
	 * @param  int $id
	 * @return void
	 */
	public function delete($id)
	{
		$vendor = $this->model->find($id);

		// Let these repositories delete the child records.
		$expense = App::make('ExpenseRepository');

		// Delete the expenses.
		foreach ($vendor->expenses as $vendorExpense)
		{
			$expense->delete($vendorExpense->id);
		}

		// Delete the client.
		$vendor->delete();
	}
}