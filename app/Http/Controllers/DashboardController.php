<?php

namespace App\Http\Controllers;
use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller {

    public function displayFigure() {
        
        $sync_info = Dashboard::getSyncInfo();
        $last_sync_date = $sync_info[0]->last_sync_date;
        $last_sync_time = $sync_info[0]->last_sync_time;
        $total_records_updated = $sync_info[0]->total_records_updated;
       
        $all_products = Dashboard::getAllProduct();
        $app_active_product = Dashboard::getAppActiveProduct();
        $app_disabled_products = Dashboard::getAppDisabledProducts();
        $inactive_products = Dashboard::getInActiveProducts();
        $incomplete_products = Dashboard::getIncompleteProducts();
        $eol_products = Dashboard::getAllEolProduct();
        $dealers = Dashboard::getAllDealers();
        $dealersNonGst = Dashboard::getAllDealersNonGST();
		
		$dealersGHY = Dashboard::getAllDealersGHY();
		$dealersNonGHY = Dashboard::getAllDealersNonGHY();
        
        
        $responseStatus = 1;

         /*
            Order Status

            NEW  : 0
            CONFIRMED : 1
            CONFIRMED_WITH_DEVIATION : 2
            HOLD : 3
            REJECT : 4 

        */
       
        $newProductOrders = Dashboard::getAllProductOrders('0');
        $new_orders_guwahati = Dashboard::guwahatiOrders('0');
        $new_orders_outside_guwahati = Dashboard::outsideGuwahatiOrders('0');
        $confirmedOrders = Dashboard::getAllProductOrders('1');
        $confirmedOrdersWithDeviations = Dashboard::getAllProductOrders('2');
        $holdedOrders = Dashboard::getAllProductOrders('3');
        $rejectedOrders = Dashboard::getAllProductOrders('4');
        $allCompletedOrders = intval($confirmedOrders) + intval($confirmedOrdersWithDeviations);

         $figures = array( 
            "responseStatus" => $responseStatus,
            "all_products" => $all_products,
            "app_active_product" => $app_active_product,
            "inactive_products" => $inactive_products,
            "incomplete_products" => $incomplete_products,
            "dealers" => $dealers,
            "nonGSTdealers" => $dealersNonGst,
            "newProductOrders" => $newProductOrders,
            "new_orders_guwahati" => $new_orders_guwahati,
            "new_orders_outside_guwahati" => $new_orders_outside_guwahati,
            "completedOrders" => $allCompletedOrders,
            "holdedOrders" => $holdedOrders,
            "rejectedOrders" => $rejectedOrders,
            "eol_products" => $eol_products,
            "app_disabled_products" => $app_disabled_products,
            "last_sync_date" => $last_sync_date,
            "last_sync_time" => $last_sync_time,
            "total_records_updated" => $total_records_updated,
			"dealersGHY" => $dealersGHY,
            "dealersNonGHY" => $dealersNonGHY
          );
          return response()->json($figures);
    }

}
