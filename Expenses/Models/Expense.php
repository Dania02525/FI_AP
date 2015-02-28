<?php

/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *  
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

namespace FI\Modules\Expenses\Models;

use App;
use Config;
use DB;
use FI\Libraries\DateFormatter;
use FI\Libraries\CurrencyFormatter;

class Expense extends \Eloquent {

	/**
     * Guarded properties
     * @var array
     */
	protected $guarded = array('id');

	public function scopeKeywords($query, $keywords)
    {
        $keywords = strtolower($keywords);       
        $query->whereHas('vendor', function($q) use($keywords)
        {
            $q->where('name', 'like', '%'.$keywords.'%');
        })
        ->orWhere('number', 'like', '%'.$keywords.'%');   
        return $query;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function vendor()
    {
        return $this->BelongsTo('FI\Modules\Vendors\Models\Vendor');
    }

    public function user()
    {
        return $this->BelongsTo('FI\Modules\Users\Models\User');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFormattedDateAttribute($value)
    {
        return DateFormatter::format($this->attributes['date']);
    }

    
     public function getFormattedAmountAttribute()
    {
        $amount = $this->attributes['amount'];

        return CurrencyFormatter::format($amount);
           
    }
}