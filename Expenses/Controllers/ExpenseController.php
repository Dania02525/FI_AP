<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *  
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Expenses\Controllers;

use App;
use Auth;
use Config;
use Event;
use FI\Libraries\BackPath;
use FI\Libraries\DateFormatter;
use FI\Libraries\HTML;
use FI\Libraries\NumberFormatter;
use FI\Libraries\Parser;
use Input;
use Redirect;
use Response;
use Session;
use View;

class ExpenseController extends \BaseController {

     /**
     * Invoice group repository
     * @var InvoiceGroupRepository
     */

    protected $invoiceGroup;

	/**
     * Expense repository
     * @var ExpenseRepository
     */

    protected $expense;

	/**
     * Expense validator
     * @var ExpenseValidator
     */

    protected $validator;

    /**
     * Dependency injection
     * @param InvoiceGroupRepository $invoiceGroup
     * @param ExpenseRepository $expense
     * @param ExpenseValidator $validator
     */

    public function __construct($invoiceGroup, $expense, $validator)
    {
        parent::__construct(); 
        $this->invoiceGroup = $invoiceGroup; 
        $this->expense      = $expense;
        $this->validator    = $validator;
    }

	/**
     * Display paginated list
     * @return View
     */
    public function index()
    {
     
        $expenses = $this->expense->getPaged(Input::get('search'), Input::get('vendor'));

        return View::make('expenses.index')
            ->with('expenses', $expenses);
    }

    public function modalCreate()
    {
        return View::make('expenses._modal_create')
             ->with('invoiceGroups', $this->invoiceGroup->lists());
    }

    public function delete($expenseId)
    {
        $this->expense->delete($expenseId);

        return Redirect::route('expenses.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }

    public function edit($id)
    {
        return View::make('expenses.edit')
        	->with('backPath', BackPath::getBackPath())
            ->with('expense', $this->expense->find($id));
    }

    public function store()
    {
        $vendor = App::make('VendorRepository');

        $validator = $this->validator->getValidator(Input::all());

        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors'  => $validator->messages()->toArray()
            ), 400);
        }
        
        $vendorId = $vendor->findIdByName(Input::get('vendor_name'));

        if (!$vendorId)
        {
            $vendorId = $vendor->create(array('name' => Input::get('vendor_name')))->id;
        }

        $input = array(
        	'user_id'          => Auth::user()->id,
        	'vendor_id' 	   => $vendorId, 
            'date'       	   => DateFormatter::unformat(Input::get('date')),
            'amount'       	   => Input::get('amount'),
            'note' 			   => Input::get('note'),
            'invoice_group_id' => Input::get('invoice_group_id'),
            'number'      	   => $this->invoiceGroup->generateNumber(Input::get('invoice_group_id'))
        );

        $expenseId = $this->expense->create($input)->id;

        return Response::json(array('success' => true, 'id' => $expenseId), 200);
    }

    public function update($id)
    {
        $validator = $this->validator->getUpdateValidator(Input::all());

        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors'  => $validator->messages()->toArray()
            ), 400);
        }  

        $vendor = App::make('VendorRepository');

        $vendorId = $vendor->findIdByName(Input::get('vendor_name'));

        if (!$vendorId)
        {
            $vendorId = $vendor->create(array('name' => Input::get('vendor_name')))->id;
        }      

        $input = array(
            'vendor_id'        => $vendorId,
            'date'       	   => DateFormatter::unformat(Input::get('date')),
            'amount'       	   => Input::get('amount'),
            'note' 			   => Input::get('note')  
        );

        $expense = $this->expense->update($input, $id);
        
        Session::flash('alertInfo', 'Expense successfully updated');

        return Response::json(array('success' => true), 200);
    }
}