<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *  
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Vendors\Controllers;

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

class VendorController extends \BaseController {

	/**
     * Vendor repository
     * @var VendorRepository
     */
    protected $vendor;

	/**
     * Vendor validator
     * @var VendorValidator
     */
    protected $validator;

    /**
     * Dependency injection
     * @param VendorRepository $vendor
     * @param VendorValidator $validator
     */

    public function __construct($vendor, $validator)
    {
        parent::__construct();  
        $this->vendor    = $vendor;
        $this->validator = $validator;
    }

    /**
     * Display paginated list
     * @return View
     */
    public function index()
    {
        
        $vendors = $this->vendor->getPaged(Input::get('search'));

        return View::make('vendors.index')
            ->with('vendors', $vendors);
    }

    /**
     * Display form for new record
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View::make('vendors.form')
            ->with('editMode', false);
    }

    /**
     * Validate and handle new record form submission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $input = Input::all();

        $validator = $this->validator->getValidator($input);

        if ($validator->fails($input))
        {
            return Redirect::route('vendors.create')
                ->with('editMode', false)
                ->withErrors($validator)
                ->withInput();
        }

        $this->vendor->create($input);

        return Redirect::to(BackPath::getBackPath('vendors/index'))
            ->with('alertSuccess', trans('fi.record_successfully_created'));
    }

    /**
     * Display a single record
     * @param  int $vendorId
     * @return \Illuminate\View\View
     */
    public function show($vendorId)
    {
        $vendor = $this->vendor->find($vendorId);

        $expenses = $vendor->expenses()
            ->orderBy('date', 'DESC')
            ->orderBy('id', 'DESC')
            ->take(Config::get('fi.defaultNumPerPage'))->get();

        return View::make('vendors.view')
            ->with('vendor', $vendor)
            ->with('expenses', $expenses);
    }

    /**
     * Display form for existing record
     * @param  int $vendorId
     * @return \Illuminate\View\View
     */
    public function edit($vendorId)
    {
        $vendor = $this->vendor->find($vendorId);

        return View::make('vendors.form')
            ->with('editMode', true)
            ->with('vendor', $vendor);
    }

    /**
     * Validate and handle existing record form submission
     * @param  int $vendorId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($vendorId)
    {
        $input = Input::all();

        $validator = $this->validator->getUpdateValidator($input, $vendorId);

        if ($validator->fails($input))
        {
            return Redirect::route('vendors.edit', array($vendorId))
                ->with('editMode', true)
                ->withErrors($validator)
                ->withInput();
        }

        $this->vendor->update($input, $vendorId);

        return Redirect::to(BackPath::getBackPath('vendors/index'))
            ->with('alertInfo', trans('fi.record_successfully_updated'));
    }

    /**
     * Delete a record
     * @param  int $vendorId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($vendorId)
    {
        $this->vendor->delete($vendorId);

        return Redirect::route('vendors.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }

    /**
     * Return a json list of records matching the provided query
     * @return json
     */
    public function ajaxNameLookup()
    {
        return $this->vendor->lookupByName(Input::get('query'));
    }

}

