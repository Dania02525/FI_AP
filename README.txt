/**
 * This file is part of the A/P Add-on for FusionInvoice.
 *  It should work with version 4.xx FusionInvoice, which use
 *  Laravel 4
 *
 * FusionInvoice is created by FusionInvoiceLLC
 * Please download it at:
 * fusioninvoice.com
 * Support its author!
 *
 * NOTE: This add on contains no code from FusionInvoice. Modifications
 * are authorized to FusionInvoice source code by the author, but they may void 
 * your support for the main product.  Install at your own risk.  
 * 
 *  A/P Add-on by <dania02525@gmail.com>
 *
 */

 Warning: BACK UP your copy of FusionInvoice before attempting to install this add on.

//**  To install with a new copy of fusionInvoice:  **//

1.  Move "Expenses" folder to FusionInvoice/app/FI/Modules
2.  Move "Venders"  folder to FusionInvoice/app/FI/Modules
3.  Move file "2015_02_03_000000_expenses.php" to FusionInvoice/app/database/migrations
4.  Move file "2015_02_05_000000_vendors.php" to FusionInvoice/app/database/migrations
5.  Move file "expense_create.js" to FusionInvoice/js/FI
6.  Move file "expense_edit.js" to FusionInvoice/js/FI
7.  Open FusionInvoice file "global.js" in FusionInvoice/js/FI, 
	add the following: 
	$('.create-invoice').click(function() {
        $('#modal-placeholder').load(createInvoiceModalRoute);
    });

    on line 52, save the file
8.  Open FusionInvoice file "master.blade.php" in FusionInvoice/app/FI/Modules/Layouts/Views/layouts, 
	add the following:
	<li class="treeview">
        <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span>Expenses</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="javascript:void(0)" class="create-expense"><i class="fa fa-angle-double-right"></i> Add Expense</a></li>
            <li><a href="{{ route('expenses.index') }}"><i class="fa fa-angle-double-right"></i> View Expenses</a></li>
        </ul>
    </li>                
    <li class="treeview">
        <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>{{ trans('fi.reports') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('reports.itemSales') }}"><i class="fa fa-angle-double-right"></i> {{ trans('fi.item_sales') }}</a></li>
            <li><a href="{{ route('reports.paymentsCollected') }}"><i class="fa fa-angle-double-right"></i> {{ trans('fi.payments_collected') }}</a></li>
            <li><a href="{{ route('reports.revenueByClient') }}"><i class="fa fa-angle-double-right"></i> {{ trans('fi.revenue_by_client') }}</a></li>
            <li><a href="{{ route('reports.taxSummary') }}"><i class="fa fa-angle-double-right"></i> {{ trans('fi.tax_summary') }}</a></li>
        </ul>
    </li>
    after the last </li>

    Then, in the same file, add the following between the <script> tags:
    var createExpenseModalRoute = '{{ route('expenses.ajax.modalCreate') }}';

    Then save the file.
9.  Upload to server and run through install process as per normal



//**  To install with an existing copy of fusionInvoice: (advanced users) **//

1.  Move "Expenses" folder to FusionInvoice/app/FI/Modules
2.  Move "Venders"  folder to FusionInvoice/app/FI/Modules
3.  Move file "2015_02_03_000000_expenses.php" to FusionInvoice/app/database/migrations
4.  Move file "2015_02_05_000000_vendors.php" to FusionInvoice/app/database/migrations
5.  Move file "expense_create.js" to FusionInvoice/js/FI
6.  Move file "expense_edit.js" to FusionInvoice/js/FI
7.  Open FusionInvoice file "global.js" in FusionInvoice/js/FI, 
	add the following: 
	$('.create-invoice').click(function() {
        $('#modal-placeholder').load(createInvoiceModalRoute);
    });

    on line 52, save the file
8.  Open FusionInvoice file "master.blade.php" in FusionInvoice/app/FI/Modules/Layouts/Views/layouts, 
	add the following:
	<li class="treeview">
        <a href="#">
            <i class="fa fa-file-text-o"></i>
            <span>Expenses</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="javascript:void(0)" class="create-expense"><i class="fa fa-angle-double-right"></i> Add Expense</a></li>
            <li><a href="{{ route('expenses.index') }}"><i class="fa fa-angle-double-right"></i> View Expenses</a></li>
        </ul>
    </li>                
    <li class="treeview">
        <a href="#">
            <i class="fa fa-bar-chart-o"></i>
            <span>{{ trans('fi.reports') }}</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('reports.itemSales') }}"><i class="fa fa-angle-double-right"></i> {{ trans('fi.item_sales') }}</a></li>
            <li><a href="{{ route('reports.paymentsCollected') }}"><i class="fa fa-angle-double-right"></i> {{ trans('fi.payments_collected') }}</a></li>
            <li><a href="{{ route('reports.revenueByClient') }}"><i class="fa fa-angle-double-right"></i> {{ trans('fi.revenue_by_client') }}</a></li>
            <li><a href="{{ route('reports.taxSummary') }}"><i class="fa fa-angle-double-right"></i> {{ trans('fi.tax_summary') }}</a></li>
        </ul>
    </li>
    after the last </li>

    Then, in the same file, add the following between the <script> tags:
    var createExpenseModalRoute = '{{ route('expenses.ajax.modalCreate') }}';

    Then save the file.
9.  Run php artisan migrate (this creates the two new tables called expenses and vendors)
10. Run php artisan dump-autoload (this creates a new classmap for fusioninvoice to find the new classes)
