<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *	
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Expenses\Repositories;

use Config;
use Event;
use FI\Modules\Expenses\Models\Expense;

class ExpenseRepository extends \FI\Libraries\BaseRepository {

	public function __construct(Expense $model)
	{
		$this->model = $model;
	}

	/**
	 * Create a record
	 * @param  array $input
	 * @return Expense
	 */

	public function create($input)
	{
		$expense = $this->model->create($input);

		Event::fire('expense.created', array($expense));

		return $expense;
	}

	public function delete($id)
	{
		$expense = $this->model->find($id);
		$expense->delete();
	}

	public function getPaged($filter = null, $vendorId = null) 
	{
		$expense = $this->model->orderBy('date', 'DESC');

		if ($filter)
		{
			$expense->keywords($filter);
		}

		if ($vendorId)
        {
            $expense->where('vendor_id', $vendorId);
        }

		return $expense->paginate(Config::get('fi.defaultNumPerPage'));
	}
}