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
7.  Move file "global.js" to FusionInvoice/js/FI, replace existing file
8.  Upload to server and run through install process as per normal



//**  To install with an existing copy of fusionInvoice: (advanced users) **//

1.  Move "Expenses" folder to FusionInvoice/app/FI/Modules
2.  Move "Venders"  folder to FusionInvoice/app/FI/Modules
3.  Move file "2015_02_03_000000_expenses.php" to FusionInvoice/app/database/migrations
4.  Move file "2015_02_05_000000_vendors.php" to FusionInvoice/app/database/migrations
5.  Move file "expense_create.js" to FusionInvoice/js/FI
6.  Move file "expense_edit.js" to FusionInvoice/js/FI
7.  Move file "global.js" to FusionInvoice/js/FI, replace existing file
8.  Navigate to fusioninvoice folder in shell
9.  Run php artisan migrate (this creates the two new tables called expenses and vendors)
10. Run php artisan dump-autoload (this creates a new classmap for fusioninvoice to find the new classes)
