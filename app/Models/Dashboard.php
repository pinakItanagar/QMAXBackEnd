<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dashboard extends Model {

    static  function getAllDealers() {
        $dealers = DB::table('dealer_master')->where('gstStatus', '=', 'GST')->where('status', '=', '1')->count();
        return $dealers;
    }

    static  function getAllDealersNonGST() {
        $dealers = DB::table('dealer_master')->where('gstStatus', '=', 'NON-GST')->where('status', '=', '1')->count();
        return $dealers;
    }
	
	static  function getAllDealersGHY() {
        $dealers = DB::table('dealer_master')->where('dealerLocation', '=', 'GUWAHATI')->where('status', '=', '1')->count();
        return $dealers;
    }

    static  function getAllDealersNonGHY() {
        $dealers = DB::table('dealer_master')->where('dealerLocation', '=', 'OUTSIDE-GUWAHATI')->where('status', '=', '1')->count();
        return $dealers;
    }

    
    static  function getAllProduct() {
        $product_count = DB::table('product_catelogue')->count();
        return $product_count;
    }

    
    static  function getAllEolProduct() {
        $product_count = DB::table('product_catelogue')->where('eol', '=', '1')->count();
        return $product_count;
    }

     static  function getAppActiveProduct() {
         $product_count = DB::table('product_catelogue')->where('display_status', '=', '1')->where('eol', '=', '0')->where('product_status', '=', '1')->count();
         return $product_count;
     }

     
    static  function getAppDisabledProducts() {
        $product_count = DB::table('product_catelogue')->where('display_status', '=', '0')->where('product_status', '=', '1')->where('eol', '=', '0')->count();
        return $product_count;
    }

    static  function getInActiveProducts() {
        $product_count = DB::table('product_catelogue')->where('display_status', '=', '0')->where('eol', '=', '0')->count();
        return $product_count;
    }


    
    static  function getIncompleteProducts() {
        $product_count = DB::table('product_catelogue')->where('product_status', '=', '0')->where('eol', '=', '0')->count();
        return $product_count;
    }

    static  function getAllProductOrders($state) {
        $product_orders = DB::table('product_order')->where('order_status', '=', $state)->count();
        return $product_orders;
    }

    static  function guwahatiOrders($state) {
        $product_orders = DB::table('product_order')
                        ->join('dealer_master', 'dealer_master.dealerMobile', '=', 'product_order.dealer_phone')
                        ->where('order_status', '=', $state)
                        ->where('dealer_master.dealerLocation', '=', 'GUWAHATI')
                        ->count();
        return $product_orders;
    }

    static  function outsideGuwahatiOrders($state) {
        $product_orders = DB::table('product_order')
                        ->join('dealer_master', 'dealer_master.dealerMobile', '=', 'product_order.dealer_phone')
                        ->where('order_status', '=', $state)
                        ->where('dealer_master.dealerLocation', '=', 'OUTSIDE-GUWAHATI')
                        ->count();
        return $product_orders;
    }


    static  function getSyncInfo() {
        $sql = "SELECT * FROM  datasynced  ORDER BY synced_id DESC LIMIT 1 ";
        $dataSync = DB::select($sql);
        return $dataSync;  
    }


}
