<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Admin\V1\MenuController;
use App\Http\Controllers\API\Admin\V1\UserinfoController;
use App\Http\Controllers\API\Admin\V1\UsersController;
use App\Http\Controllers\API\Admin\V1\BranchController;
use App\Http\Controllers\API\POS\V1\CategoryController;
use App\Http\Controllers\API\POS\V1\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\API\Global\ComboController;
use App\Http\Controllers\API\Exists\CheckingController;
use App\Http\Controllers\API\POS\V1\AuthCountStockController;
use App\Http\Controllers\API\POS\V1\AuthPurchaseOrderController;
use App\Http\Controllers\API\POS\V1\AuthStockTransferController;
use App\Http\Controllers\API\POS\V1\CountStockController;
use App\Http\Controllers\API\POS\V1\CustomerController;
use App\Http\Controllers\API\POS\V1\ExchangeratesControllers;
use App\Http\Controllers\API\POS\V1\PosController;
use App\Http\Controllers\API\POS\V1\PurchaseOrderController;
use App\Http\Controllers\API\POS\V1\StockController;
use App\Http\Controllers\API\POS\V1\StockTransferController;
use App\Http\Controllers\API\POS\V1\SupplyController;
use App\Http\Controllers\API\Setting\V1\PermissionController;
use App\Http\Controllers\API\Somnong\V1\AuthPaymentController;
use App\Http\Controllers\API\Somnong\V1\AuthQuoteController;
use App\Http\Controllers\API\Somnong\V1\SomnongClientController;
use App\Http\Controllers\API\Somnong\V1\SomnongController;
use App\Http\Controllers\API\Somnong\V1\somnongPaymentController;
use App\Http\Controllers\API\Somnong\V1\SomnongQuoteController;
use App\Http\Controllers\API\Somnong\V1\SomnongStaffController;
use App\Models\api\somnong\somnongStaffInfo;

Route::post('login', [LoginController::class, 'login']);
Route::post('refreshtoken', [LoginController::class, 'refresh']);

Route::prefix('pb')->group(function () {
    // Get data for public function 
    Route::get('systems', [ComboController::class, 'systems']);
    Route::any('user_email', [CheckingController::class, 'user_email']);

    // Register in public function 
    Route::post('registerStore', [BranchController::class, 'registerStore']);
});

Route::prefix('gb')->middleware('auth:api')->group(function () {
    Route::post('registerStore', [BranchController::class, 'registerStore']);
    Route::get('combo/{id}', [ComboController::class, 'combo']);
    Route::get('combo_sys/{id}', [ComboController::class, 'combo_sys']);
    Route::get('combo_branch/{id}', [ComboController::class, 'combo_branch']);
    Route::get('comboByBranch/{id}', [ComboController::class, 'comboByBranch']);

    Route::any('ch_user_email', [CheckingController::class, 'ch_user_email']);
});

Route::prefix('admin')->middleware('auth:api')->group(function () {
    Route::resource('get-product', ProductController::class);
    Route::get('alluser', [UserinfoController::class, 'index']);
    Route::get('auth', [UserinfoController::class, 'auth']);
});

Route::prefix('users')->middleware('auth:api')->group(function () {
    Route::get('Loggedin', [UsersController::class, 'Loggedin']);
    Route::post('create_user', [UsersController::class, 'create_user']);
    Route::post('user_upload_image', [UsersController::class, 'user_upload_image']);
    Route::get('user_view_image/{filename}', [UsersController::class, 'user_view_image']);
    Route::get('user_profile_image/{filename}', [UsersController::class, 'user_profile_image']);
});

Route::prefix('setting')->middleware('auth:api')->group(function () {
    // Get profile:
    Route::get('profile_system/{id}', [PermissionController::class, 'gb_profile_system']);
    Route::get('main_menu', [PermissionController::class, 'gb_main_menu']);

    Route::get('system_list', [MenuController::class, 'system_list']);
    Route::get('getmenu', [MenuController::class, 'index']);
    Route::get('menu_by_system/{id}', [MenuController::class, 'menu_by_system']);
    Route::get('get_sub_menu_list/{id}', [MenuController::class, 'get_sub_menu_list']);

    // Permission Menu



    // Permission Menu
    Route::get('sub_menu_list/{system_id}/{profile_id}/{menu_id}', [MenuController::class, 'sub_menu_list']);
    Route::get('get_left_menu', [MenuController::class, 'get_left_menu']);
    Route::get('get_left_menu_byId/{id}', [MenuController::class, 'get_left_menu_byId']);

    // Permission 

    Route::post('add_permission_menu', [MenuController::class, 'add_permission_menu']);
    Route::post('delete_permission', [MenuController::class, 'delete_permission']);
    
    //
    // POST
    Route::post('create_left_menu', [MenuController::class, 'create_left_menu']);


    // Branch
    Route::post('create_branch', [BranchController::class, 'create_branch']);
    Route::get('getbranch', [BranchController::class, 'all_branch']);
    Route::get('getbranch_byId/{id}', [BranchController::class, 'get_branch_byId']);

    // Get Users
    Route::get('getuser', [UserinfoController::class, 'getUsers']);

    // Create user
    Route::post('create_user', [UserinfoController::class, 'create_user']);
    Route::get('get_user_byId/{id}', [UserinfoController::class, 'get_user_byId']);

    // Permission
    Route::get('permission_menu/{id}', [PermissionController::class, 'permission_menu']);
    Route::get('permission_sub/{id}', [PermissionController::class, 'permission_sub']);
    Route::post('permission_refresh', [PermissionController::class, 'permission_refresh']);

    Route::post('create_permission', [PermissionController::class, 'create_permission']);
    Route::post('permission', [PermissionController::class, 'permission']);

});

Route::prefix('pos')->middleware('auth:api')->group(function () {

    //POS function global
    Route::get('search_items/{id}', [ProductController::class, 'search_items']);
    Route::get('search_pos/{id}', [PosController::class, 'search_pos']);

    // Combox
    Route::get('combo/{id}', [PosController::class, 'pos_combo']);

    Route::get('currency/{id}', [PosController::class, 'pos_currency']);

    // Register Stock by branch
    Route::post('create_stock', [StockController::class, 'create_stock']);
    Route::get('getStock', [StockController::class, 'getStock']);
    Route::get('getStock_byId/{id}', [StockController::class, 'getStock_byId']);

    // Register product
    Route::post('create_product', [ProductController::class, 'create_product']);
    Route::get('getProduct', [ProductController::class, 'getProduct']);
    Route::get('Product_byId/{id}', [ProductController::class, 'Product_byId']);
    Route::get('pro_by_category/{id}', [ProductController::class, 'pro_by_category']);

    Route::post('product_upload_image', [ProductController::class, 'product_upload_image']);
    Route::post('del_product_image', [ProductController::class, 'del_product_image']);
    Route::get('product_image/{pro_id}', [ProductController::class, 'product_image']);


    // Register Customer

    Route::post('create_customer', [CustomerController::class, 'create_customer']);
    Route::get('getCustomer', [CustomerController::class, 'getCustomer']);
    Route::get('Customer_byId/{id}', [CustomerController::class, 'Customer_byId']);


    // Register Supply
    Route::post('create_supply', [SupplyController::class, 'create_supply']);
    Route::get('getSupply', [SupplyController::class, 'getSupply']);
    Route::get('Supply_byId/{id}', [SupplyController::class, 'Supply_byId']);

    // Register PO
    Route::post('create_po', [PurchaseOrderController::class, 'create_po']);
    Route::get('una_po_list', [PurchaseOrderController::class, 'una_po_combo']);
    Route::get('una_po_by_id/{id}', [PurchaseOrderController::class, 'una_po_by_id']);

    // Register PO details
    Route::post('create_po_details', [PurchaseOrderController::class, 'create_po_details']);
    Route::get('una_po_details_id/{id}', [PurchaseOrderController::class, 'una_po_details_batch']);
    Route::get('una_po_sysdoc/{id}', [PurchaseOrderController::class, 'una_po_sysdoc']);

    // Register PO Authorize
    Route::get('una_purchase_order', [AuthPurchaseOrderController::class, 'una_purchase_order']);
    Route::get('una_po_view/{id}', [AuthPurchaseOrderController::class, 'una_po_view']);
    Route::get('una_po_details/{id}', [AuthPurchaseOrderController::class, 'una_po_details']);

    // Auth
    Route::post('auth_purchaseorder', [AuthPurchaseOrderController::class, 'auth_purchaseorder']);
    Route::post('reject_purchaseorder', [AuthPurchaseOrderController::class, 'reject_purchaseorder']);


    // Register Category
    Route::post('create_category', [CategoryController::class, 'create_category']);
    Route::get('pos_category', [CategoryController::class, 'pos_category']);
    Route::get('view_category/{id}', [CategoryController::class, 'view_category']);

    // Register Stock Transfer
    Route::post('create_stock_transfer', [StockTransferController::class, 'create_stock_transfer']);
    Route::get('una_transfer_list', [StockTransferController::class, 'una_transfer_combo']);
    Route::get('una_transfer_list/{id}', [StockTransferController::class, 'una_transfer_by_id']);

    // Register Stock Transfer Detail
    Route::post('create_transfer_details', [StockTransferController::class, 'create_transfer_details']);
    Route::get('una_transfer_id/{id}', [StockTransferController::class, 'una_transfer_batch']);
    Route::get('una_transfer_sysdoc/{id}', [StockTransferController::class, 'una_transfer_sysdoc']);

    // Register Transfer Authorize
    Route::get('una_stock_transfer', [AuthStockTransferController::class, 'una_stock_transfer']);
    Route::get('una_stock_transfer/{id}', [AuthStockTransferController::class, 'una_transfer_view']);
    Route::get('una_transfer_details/{id}', [AuthStockTransferController::class, 'una_transfer_details']);


    // Auth Stock Transfer
    Route::post('auth_transfer', [AuthStockTransferController::class, 'auth_transfer']);
    Route::post('reject_transfer', [AuthStockTransferController::class, 'reject_transfer']);

    // Counst Stock
    Route::post('create_count_stock', [CountStockController::class, 'create_count_stock']);
    Route::get('una_count_list', [CountStockController::class, 'una_count_combo']);
    Route::get('una_count_list/{id}', [CountStockController::class, 'una_count_stock_by_id']);

    // Register Count Stock Detail
    Route::post('create_count_stock_details', [CountStockController::class, 'create_count_stock_details']);
    Route::get('una_count_stock_id/{id}', [CountStockController::class, 'una_count_stock_batch']);
    Route::get('una_count_stock_sysdoc/{id}', [CountStockController::class, 'una_count_stock_sysdoc']);

    // Register Count Stock Authorize
    Route::get('una_count_stock', [AuthCountStockController::class, 'una_count_stock']);
    Route::get('una_count_stock/{id}', [AuthCountStockController::class, 'una_count_stock_view']);
    Route::get('una_count_stock_details/{id}', [AuthCountStockController::class, 'una_count_stock_details']);

    // Auth Stock Transfer
    Route::post('auth_count_stock', [AuthCountStockController::class, 'auth_count_stock']);
    Route::post('reject_count_stock', [AuthCountStockController::class, 'reject_count_stock']);

    // Point Of Sale
    Route::get('pos_by_category/{id}', [PosController::class, 'top_pos_by_category']);
    Route::get('ProductDefault/{id}', [PosController::class, 'una_pos_product']);
    Route::get('una_pos/{id}', [PosController::class, 'una_pos_trans']);
    Route::get('una_pos_sysdoc/{id}', [PosController::class, 'una_pos_sysdoc']);
    Route::get('productById/{id}', [PosController::class, 'productById']);

    Route::get('una_pos_details/{id}', [PosController::class, 'una_pos_details']);
    Route::get('una_point_of_sale', [PosController::class, 'una_point_of_sale']);

    Route::post('create_pos_invoice', [PosController::class, 'create_pos_invoice']);
    Route::post('create_pos_details', [PosController::class, 'create_pos_details']);
    Route::post('pos_delete_sysdoc', [PosController::class, 'pos_delete_sysdoc']);

    // POS Charge
    Route::post('pos_charges', [PosController::class, 'pos_charges']);


    // Auth Point Of Sale
    Route::post('auth_point_of_sale', [PosController::class, 'auth_point_of_sale']);
    Route::post('reject_point_of_sale', [PosController::class, 'reject_point_of_sale']);


    //Route::post('create_stock_transfer', [PosController::class, 'create_stock_transfer']);

    // Exchange Rate
    Route::post('create_base_exchange', [ExchangeratesControllers::class, 'create_base_exchange']);
    Route::post('create_exchange_rates', [ExchangeratesControllers::class, 'create_exchange_rates']);
    Route::get('list_currency', [ExchangeratesControllers::class, 'list_currency']);

    Route::post('create_vat', [ExchangeratesControllers::class, 'create_vat']);
    Route::get('pos_vat', [ExchangeratesControllers::class, 'list_vat']);
});


Route::prefix('somnong')->middleware('auth:api')->group(function () {
    // Combox
    Route::get('combo/{id}', [SomnongController::class, 'combobox']);
    Route::get('clients/{id}', [ComboController::class, 'somnong_clients']);
    Route::get('somnongcombo/{id}', [SomnongController::class, 'somnongcombo']);

    // Register Clients 
    Route::post('create_clients', [SomnongClientController::class, 'create_clients']);
    Route::get('getClients', [SomnongClientController::class, 'getClients']);

    Route::get('clients_byId/{id}', [SomnongClientController::class, 'clients_byId']);

    // Register Quotation 
    Route::post('create_quotation', [SomnongQuoteController::class, 'create_quotation']);
    Route::get('getQuotation', [SomnongQuoteController::class, 'getQuotation']);
    Route::get('quotes_byId/{id}', [SomnongQuoteController::class, 'quotes_byId']);


    /// File 

    Route::post('quote_file', [SomnongQuoteController::class, 'quote_file']);
    Route::get('quote_file/{quote_code}', [SomnongQuoteController::class, 'quote_file_view']);
    Route::get('somnong_download_quote/{file_name}', [SomnongQuoteController::class, 'quote_file_download']);
    Route::post('del_quote_file', [SomnongQuoteController::class, 'del_quote_file']);

    /// Payment 
    Route::post('somnong_payment', [somnongPaymentController::class, 'create_somnong_payment']);
    Route::get('somnong_payment/{id}', [somnongPaymentController::class, 'somnong_payment']);
    // Get List
    Route::get('getPayment', [somnongPaymentController::class, 'getPayment']);
    Route::get('payment_file/{quote_code}', [somnongPaymentController::class, 'payment_file']);

    /// Payment File
    Route::post('payment_upload_file', [somnongPaymentController::class, 'payment_upload_file']);
    Route::post('del_payment_file', [somnongPaymentController::class, 'del_payment_file']);

    /// Authorize Somnong 
    Route::get('una_somnong_quotes', [AuthQuoteController::class, 'una_somnong_quotes']);
    Route::get('auth_quote_view/{id}', [AuthQuoteController::class, 'auth_quote_view']);

    Route::post('auth_somnong_quotes', [AuthQuoteController::class, 'auth_somnong_quote']);
    Route::post('reject_somnong_quotes', [AuthQuoteController::class, 'reject_somnong_quote']);


    /// Authorize Payment 
    Route::get('una_somnong_payment', [AuthPaymentController::class, 'una_somnong_payment']);
    Route::get('auth_payment_view/{id}', [AuthPaymentController::class, 'auth_payment_view']);

    Route::post('auth_somnong_payments', [AuthPaymentController::class, 'auth_somnong_payments']);
    Route::post('reject_somnong_payments', [AuthPaymentController::class, 'reject_somnong_payment']);


    /// Staff information 
    Route::get('getStaff', [SomnongStaffController::class, 'getStaff']);
    Route::post('create_staff', [SomnongStaffController::class, 'create_staff']);
    Route::get('staff_byId/{id}', [SomnongStaffController::class, 'staff_byId']);
});
