<?php

namespace App\Http\Controllers;
use App\Models\Adminuser;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function verifyUser( Request $request )   {

        $userEmail = trim($request->userEmail);
        $userPassword = trim($request->userPassword);
        $result = Adminuser::verifyUser($userEmail, $userPassword);  

        if(!isset($result[0]->webapp_user_id)) {
            $responseStatus = 0;
            $msg = "Invalid user ID / Password !";
            $user = array("responseStatus" => $responseStatus, "msg" => $msg);
        } else {

            $userName = $result[0]->first_name." ".$result[0]->last_name;
            $userEmail = $request->userEmail;
            $userDesignation = $result[0]->user_designation;
            $userRole = $result[0]->user_role;
            $userID = $result[0]->webapp_user_id;
            $responseStatus = 1;

            $user = array( 
                "responseStatus" => $responseStatus,
                "userID" => $userID,
                "userName" => $userName,
                "userEmail" => $userEmail,
                "userDesignation" => $userDesignation,
                "userRole" => $userRole
              );

        }

        return response()->json($user);
    
    }
	
	
	public function AppUserUniqueAccessLog(Request $request ) {
        
        $login_date = trim($request->login_date);
        $result = Adminuser::AppUserUniqueAccessLog( $login_date); 
       
        $dealerData = array( 
            "responseStatus" => '1',
            "dealers" => $result,
            "login_date" =>  $login_date
          );
        return response()->json( $dealerData);

    }
}
