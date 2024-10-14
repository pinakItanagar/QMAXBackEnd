<?php

namespace App\Http\Controllers;
use App\Models\Dealers;
use Illuminate\Http\Request;

class DealerController extends Controller {
    
    public function listing() {
        //$dealer_list = Dealers::select('dealer_id','firmName', 'contactName', 'dealerMobile', 'cityName')->where('gstStatus', 'GST')->orderBy('dealer_id', 'desc')->get();
        $dealer_list = Dealers::getAllGSTDealers(); 
        $responseStatus = 1;

        $dealers = array( 
            "responseStatus" => $responseStatus,
            "dealers" => $dealer_list
          );
       
        return response()->json($dealers);
    }


    public function nonGSTlisting() {
        //$dealer_list = Dealers::select('dealer_id','firmName', 'contactName', 'dealerMobile', 'cityName')->where('gstStatus', 'NON-GST')->orderBy('dealer_id', 'desc')->get();
        $dealer_list = Dealers::getAllNonGSTDealers(); 
        $responseStatus = 1;

        $dealers = array( 
            "responseStatus" => $responseStatus,
            "dealers" => $dealer_list
          );
       
        return response()->json($dealers);
    }


    public function dealerlistbylocation($location) {
 
      if($location == "L") {
        $dealer_list = Dealers::getDealerListByLocation('GUWAHATI'); 
      } else {
        $dealer_list = Dealers::getDealerListByLocation('OUTSIDE-GUWAHATI');
      }
      $responseStatus = 1;

      $dealers = array( 
          "responseStatus" => $responseStatus,
          "dealers" => $dealer_list
        );
     
      return response()->json($dealers);
  }


    public  function getdealerdetails(Request $request) {
    
      $dealer_info = Dealers::getDealerByID($request->dealer_id);
     
      $responseStatus = 1;  
      $dealer_details = array( 
        "responseStatus" => $responseStatus,
        "dealer" => $dealer_info
      );
   
      return response()->json($dealer_details);

    }

    public  function updatedealer(Request $request) {
      $dealer_id = $request->dealer_id;
      $emailAddress = $request->emailAddress;
      $dealerWhatsApp = $request->dealerWhatsApp;
      $status = $request->status;
      $gstStatus = $request->gstStatus;

      if($gstStatus == 'NON-GST') {

        if($request->gstNo) {
          $gstNo = $request->gstNo;
          $gstStatus = "GST" ;
        } else {
          $gstNo = "";
        }


        Dealers::where('dealer_id', $dealer_id)
        ->update(array(
           'status' => $status,
           'emailAddress' => $emailAddress,
           'dealerWhatsApp' => $dealerWhatsApp,
           'gstStatus' => $gstStatus,
           'gstNo' => $gstNo,
           'updated_at' => date("Y-m-d H:i:s")
        )); 
      } else {
        
        Dealers::where('dealer_id', $dealer_id)
        ->update(array(
           'status' => $status,
           'emailAddress' => $emailAddress,
           'dealerWhatsApp' => $dealerWhatsApp,
           'updated_at' => date("Y-m-d H:i:s")
        )); 

      }

   

      
        $responseStatus = 1;  
        $dealer_details = array( "responseStatus" => $responseStatus );
        return response()->json($dealer_details);
    
    }  


    
}
