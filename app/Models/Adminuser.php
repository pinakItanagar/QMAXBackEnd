<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Adminuser extends Model
{
    //use HasFactory;
    protected $table = 'webadmin_user';
    static  function verifyUser($username, $pswd) {

        $user = self::where('user_email', '=',$username)
        ->where('user_pswd', '=',  md5($pswd))
        ->get();
        return $user;

    }
	
	
	static function AppUserUniqueAccessLog($date) {
		
		$sql = "SELECT row_number() over (order by dealer_master.dealer_id ) as id, dealer_master.dealer_id, dealer_master.firmName, dealer_master.contactName, user_access_log.userID, user_access_log.login_date ";
        $sql .= "FROM  user_access_log , dealer_master WHERE  user_access_log.login_date = '". $date."' AND ";
        $sql .=  " dealer_master.dealerMobile = user_access_log.userID " ;
        $sql .=  " GROUP BY dealer_master.dealer_id, dealer_master.firmName, dealer_master.contactName, user_access_log.userID, user_access_log.login_date ORDER BY id ASC   " ;
      
		
		/*
        $sql = "SELECT row_number() over (order by dealer_master.dealer_id ) as dealer_id, dealer_master.firmName, dealer_master.contactName, user_access_log.userID, user_access_log.login_date ";
        $sql .= "FROM  user_access_log , dealer_master WHERE  user_access_log.login_date = '". $date."' AND ";
        $sql .=  " dealer_master.dealerMobile = user_access_log.userID " ;
        $sql .=  " GROUP BY dealer_master.dealer_id, dealer_master.firmName, dealer_master.contactName, user_access_log.userID, user_access_log.login_date  " ;
        */
		
        /*
        $users = DB::table('user_access_log')
        ->join('dealer_master', 'dealer_master.dealerMobile', '=', 'user_access_log.userID')
        ->select('dealer_master.dealer_id', 'dealer_master.firmName', 'dealer_master.contactName', 'user_access_log.userID', 'user_access_log.login_date')
        ->where('user_access_log.login_date', '=', $date)
        ->groupBy('dealer_master.dealer_id', 'dealer_master.firmName', 'dealer_master.contactName', 'user_access_log.userID', 'user_access_log.login_date')
        ->get();
        */
        $users = DB::select($sql);
        return $users;

    }
	
	
}
