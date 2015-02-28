<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *  
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Vendors\Models;

use App;
use Config;
use DB;
use FI\Libraries\CurrencyFormatter;


class Vendor extends \Eloquent {

	/**
     * Guarded properties
     * @var array
     */
	protected $guarded = array('id');

	public function scopeKeywords($query, $keywords)
    {
        $keywords = strtolower($keywords);

        $query->where('name', 'like', '%'.$keywords.'%')
        ->orWhere('email', 'like', '%'.$keywords.'%') 
        ->orWhere('phone', 'like', '%'.$keywords.'%')
        ->orWhere('mobile', 'like', '%'.$keywords.'%');     
        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function expenses()
    {
        return $this->hasMany('FI\Modules\Expenses\Models\Expense');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedTotalAttribute()
    {
        $id = $this->attributes['id'];

        return CurrencyFormatter::format(DB::table('expenses')->where('vendor_id', $id)->sum('amount'));
           
    }

     public function getFormattedAddressAttribute()
    {
        return nl2br($this->attributes['address']);
    }
}