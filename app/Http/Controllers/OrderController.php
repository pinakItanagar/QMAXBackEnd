<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
class OrderController extends Controller {
    public function neworders() {
        $order_status = 0;
        $order_list = Orders::getAllProductOrders($order_status);
        $responseStatus = 1;

        $orders = array( 
            "responseStatus" => $responseStatus,
            "orders" => $order_list
          );
       
        return response()->json($orders);
    }


    public function holdedorders() {
      $order_status = 3 ;
      $order_list = Orders::getAllProductOrders($order_status);
      $responseStatus = 1;

      $orders = array( 
          "responseStatus" => $responseStatus,
          "orders" => $order_list
        );
     
      return response()->json($orders);
   }


   public function rejectedorders() {
    $order_status = 4 ;
    $order_list = Orders::getAllProductOrders($order_status);
    $responseStatus = 1;

    $orders = array( 
        "responseStatus" => $responseStatus,
        "orders" => $order_list
      );
   
    return response()->json($orders);
 }



   public function confirmedorders() {
     
      $order_list = Orders::getAllConfirmedOrders();
      $responseStatus = 1;

      $orders = array( 
          "responseStatus" => $responseStatus,
          "orders" => $order_list
        );
     
      return response()->json($orders);
  }


    public  function vieworder(Request $request) {
    
      $order_info = Orders::getOrderByOrderNo($request->order_number);
     
      $responseStatus = 1;  
      $order_details = array( 
        "responseStatus" => $responseStatus,
        "order" => $order_info
      );
   
      return response()->json($order_details);

    }


    public  function updateorder(Request $request) {
        $order_number = $request->order_number;
        $order_status_text = $request->order_status;
        $box_required_updated = $request->box_required_updated;
        $user_email = $request->user_email;
        $remark = strtoupper(trim($request->remark));
        $order_status = 0;

        /*
            Order Status

            NEW  : 0
            CONFIRMED : 1
            CONFIRMED_WITH_DEVIATION : 2
            HOLD : 3
            REJECT : 4 

        */

        if($order_status_text == "CONFIRMED") {
          $order_status = 1;
          $box_required_updated = "";
        } elseif($order_status_text == "CONFIRMED_WITH_DEVIATION") {
          $order_status = 2;
        } elseif($order_status_text == "HOLD") {
          $order_status = 3;
          $box_required_updated = "";
        } elseif($order_status_text == "REJECT") {  
          $order_status = 4;
          $box_required_updated = "";
        }  

        Orders::where('order_number', $order_number)
        ->update(array(
           'order_status' => $order_status,
           'order_status_text' => $order_status_text,
           'box_required_updated' => $box_required_updated,
           'order_remark' => $remark,
           'user_email' => $user_email,
           'updated_at' => date("Y-m-d H:i:s")
        )); 

        
    
      $responseStatus = 1;  
      $order_details = array( "responseStatus" => $responseStatus );
      return response()->json($order_details);
    }
}
