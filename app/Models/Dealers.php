<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dealers extends Model {
   // use HasFactory;
   protected $table = 'dealer_master';
   protected $primaryKey = 'dealer_id';

   static function getAllGSTDealers() {
		
      $sql = "SELECT row_number() over (order by dealer_id ) as id, dealer_id, firmName, contactName, cityName, dealerMobile, gstNo ";
      $sql .= "FROM   dealer_master WHERE gstStatus = 'GST' ORDER BY dealer_id DESC ";
      $dealers = DB::select($sql);
      return $dealers;

  }
  
  static function getAllNonGSTDealers() {
		
      $sql = "SELECT row_number() over (order by dealer_id ) as id, dealer_id, firmName, contactName, cityName, dealerMobile ";
      $sql .= "FROM   dealer_master WHERE gstStatus = 'NON-GST' ORDER BY dealer_id DESC ";
      $dealers = DB::select($sql);
      return $dealers;

  }


  static function getDealerListByLocation($location) {
		
   $sql = "SELECT row_number() over (order by dealer_id ) as id, dealer_id, firmName, contactName, cityName, dealerMobile, gstNo ";
   $sql .= "FROM   dealer_master WHERE dealerLocation = '".$location."' ORDER BY dealer_id DESC ";
   $dealers = DB::select($sql);
   return $dealers;

}

  static  function getDealerByID($dealer_id) {

     $dealer_info = DB::table('dealer_master')->where('dealer_id', $dealer_id)->first();
     return $dealer_info;
    
   }
 

}
