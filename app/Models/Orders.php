<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model {

    protected $table = 'product_order';
    static  function getAllProductOrders($status) {
        $orders = DB::table('product_order')
        ->join('dealer_master', 'dealer_master.dealerMobile', '=', 'product_order.dealer_phone')
        ->select('product_order.*', 'dealer_master.firmName')
        ->where('order_status', '=', $status)
        ->orderBy('order_date', 'desc')
        ->get();
        return $orders;
    }

    static  function getAllConfirmedOrders() {
        $orders = DB::table('product_order')
        ->join('dealer_master', 'dealer_master.dealerMobile', '=', 'product_order.dealer_phone')
        ->select('product_order.*', 'dealer_master.firmName')
        ->whereIN('order_status', [1, 2])
        ->orderBy('order_date', 'desc')
        ->get();
        return $orders;
    }

    static  function getOrderByOrderNo($order_number) {
        
        $order_info = DB::table('product_order')
                        ->select(
                            'order_id', 
                            'part_no',
                            'order_number', 
                            'box_required',
                            'dealer_phone',
                            'order_date',
                            'order_status',
                            'order_status_text',
                            'order_remark',
                            'box_required_updated',
                            'user_email',
                            'firmName',
                            'contactName',
                            'cityName',
                            'gstNo',
                            'product_name_tally',
                            'product_size_mm',
                            'product_size_inches',
                            'finish',
                            'primary_category',
                            'product_order.updated_at',
                            'product_type' )
                        ->join('dealer_master', 'dealer_master.dealerMobile', '=', 'product_order.dealer_phone')
                        ->join('product_catelogue', 'product_catelogue.part_no', '=', 'product_order.product_name')
                        ->where('order_number', '=', $order_number)
                        ->get(); 
                      return $order_info;
        
    }
}
