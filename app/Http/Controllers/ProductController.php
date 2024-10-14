<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\File;

class ProductController extends Controller {

    public function listing() {
        $is_production = true; 
        $basePath = "";
        $product_list = Product::select('product_ct_id','part_no', 'product_name_tally', 'product_size_inches', 'primary_category', 'product_type', 'is_image')->orderBy('product_name_tally', 'asc')->get();
        $responseStatus = 1;

        if($is_production == true) {
          $basePath = "C:\\xampp\\htdocs\\mis.qmaxonline.com\\uploads\\";
        } else {
          $basePath = "C:\\xampp\\htdocs\\qmax\\webadmin\\public\\uploads\\";
        }

        foreach ($product_list as $product) {
         
          
          if(!file_exists($basePath.$product->part_no.'.jpg')) {
             $product->is_image = '0';
          }
     
        }

        $products = array( 
            "responseStatus" => $responseStatus,
            "products" => $product_list
          );
       
        return response()->json($products);
    }


    public function incompletelisting() {
     
        $product_list = Product::select('product_ct_id','part_no', 'product_name_tally', 'product_size_inches', 'primary_category', 'product_type')
								->where('product_status', '=', '0')
								->where('eol', '=', '0')
								->orderBy('product_name_tally', 'asc')
								->get();
        $responseStatus = 1;

        $products = array( 
            "responseStatus" => $responseStatus,
            "products" => $product_list
          );
       
        return response()->json($products);
    
    }

    
    
    public function appactiveproductlisting() {

      $product_list = Product::select('product_ct_id','part_no', 'product_name_customer', 'product_name_tally', 'product_size_inches', 'primary_category', 'product_type', 'is_qrcode')
      ->where('product_status', '=', '1')
      ->where('eol', '=', '0')
      ->where('display_status', '=', '1')
      ->orderBy('product_name_tally', 'asc')
      ->get();
      $responseStatus = 1;

      $products = array( 
          "responseStatus" => $responseStatus,
          "products" => $product_list
        );
     
      return response()->json($products);
    }

    public function appdisabledproductslisting() {

      $product_list = Product::select('product_ct_id','part_no', 'product_name_tally', 'product_size_inches', 'primary_category', 'product_type')
      ->where('product_status', '=', '1')
      ->where('eol', '=', '0')
      ->where('display_status', '=', '0')
      ->orderBy('product_name_tally', 'asc')
      ->get();
      $responseStatus = 1;

      $products = array( 
          "responseStatus" => $responseStatus,
          "products" => $product_list
        );
     
      return response()->json($products);
    }

    public function eolproductlisting() {

      $product_list = Product::select('product_ct_id','part_no', 'product_name_tally', 'product_size_inches', 'primary_category', 'product_type')
      ->where('eol', '=', '1')
      ->orderBy('product_name_tally', 'asc')
      ->get();
      $responseStatus = 1;

      $products = array( 
          "responseStatus" => $responseStatus,
          "products" => $product_list
        );
     
      return response()->json($products);

    }

    public function IncompleteProductDetails( Request $request )   {
      $product_details = Product::getProductByID(trim($request->product_ct_id));
      $responseStatus = 1;  
      $product = array( 
        "responseStatus" => $responseStatus,
        "product" => $product_details
      );
   
      return response()->json($product);
    }


    public function UpdateProduct( Request $request )   {
     
      $product_ct_id  = trim($request->product_ct_id);
      $part_no = trim($request->part_no);
      $product_name_tally  = trim(strtoupper($request->product_name_tally));
      $product_name_customer  = trim(strtoupper($request->product_name_customer));
      $product_size_mm  = trim(strtoupper($request->product_size_mm));
      $product_size_inches  = trim(strtoupper($request->product_size_inches));
      $finish  = trim(strtoupper($request->finish));
      $primary_category  = trim(strtoupper($request->primary_category));
      $product_type  = trim(strtoupper($request->product_type));
      $item_per_box  = trim(strtoupper($request->item_per_box));
      $sqr_ft_per_box  = trim(strtoupper($request->sqr_ft_per_box));
      $display_status  = trim($request->display_status);
      $db_image_status  = trim($request->db_image_status);
      $is_image = 0;
      $newFileName = "";
      $remark = "" ;
      $is_production = true;

      if($request->file('productImage')) {

        $file = $request->file('productImage');
        $fileExt = $file->getClientOriginalExtension();
        $newFileName  = $part_no.".".$fileExt;

        $destinationPath = 'uploads';
        $file->move($destinationPath, $newFileName);

        if($is_production == true) {
         
          $basePath = "C:\\xampp\\htdocs\\mis.qmaxonline.com\\uploads\\";
          $source = "C:\\xampp\\htdocs\\mis.qmaxonline.com\\uploads\\".$newFileName;
          $destination = "C:\\nginx\\html\\uploads\\images\\".$newFileName;
          
        } else {  

          $basePath = "C:\\xampp\\htdocs\\qmax\\webadmin\\public\\uploads\\";
          $source = "C:\\xampp\\htdocs\\qmax\\webadmin\\public\\uploads\\".$newFileName;
          $destination = "C:\\nginx\\html\\uploads\\images\\".$newFileName;

        }
        
        
      
        
        if(file_exists($basePath.$part_no.'.jpg')) {
           
              if( copy($source, $destination) ) { 
                $is_image = 1;
              } else {
                $is_image = 2;
              }
        
        } elseif($fileExt != "jpg") {
          $is_image = 3;
          $remark = "Non JPG " ;
        }



      }  else {

        if($db_image_status == "1" ) {
          $is_image = 1;
        } else {
          $is_image = 0;
        }

      }

     
      

      if ( 
        
         ($part_no != "") && ($product_name_tally != "") && ($part_no != "") && 
         ($product_name_customer != "") && ($product_size_mm != "") && ($product_size_inches != "") &&
         ($finish != "") && ($primary_category != "") && ($product_type != "") &&
         ($item_per_box != "") && ($sqr_ft_per_box != "") &&  ($is_image == "1") 
         ) {
          $product_status = 1;
          $response_message = "Complete product details uploaded !";

      } else {
          $product_status = 0;
          if($is_image == 1) {
            $response_message = "Product details upload pending !";
          } elseif($is_image == 0) {
            $response_message = "Product details & image upload pending !";
          } elseif($is_image == 2) {
            $response_message = "Product details upload pending & image not configured for mobile app !";
          } elseif($is_image == 3) {
            $response_message = "Product details upload pending & image format mis-match ! use (.jpg) image only : example abc.jpg ";
          }
      }

      $responseStatus = 1;  
      


      Product::where('product_ct_id', $product_ct_id)
               ->update(array(
                  'part_no' => $part_no,
                  'product_name_tally' => $product_name_tally,
                  'product_name_customer' => $product_name_customer,
                  'product_size_mm' => $product_size_mm,
                  'product_size_inches' => $product_size_inches,
                  'finish' => $finish,
                  'primary_category' => $primary_category,
                  'product_type' => $product_type,
                  'item_per_box' => $item_per_box,
                  'sqr_ft_per_box' => $sqr_ft_per_box,
                  'product_images' => $newFileName,
                  'display_status' => $display_status,
                  'is_image' => $is_image,
                  'product_status' => $product_status,
                  'remark' => $remark,
                  'updated_at' => date("Y-m-d H:i:s")
               )); 

    

      
      $product = array( 
        "responseStatus" => $responseStatus,
        "response_message" => $response_message
      );
   
      return response()->json($product);
    }

    public function UpdateProductImage( Request $request )   {

      $product_ct_id  = trim($request->product_ct_id);
      $productNameCustomer  = trim($request->productNameCustomer);
      $part_no = trim($request->part_no);
      $eol_status = trim($request->eol_status);
      $display_status = trim($request->display_status);
      $op_status = false;
      $is_production = true;

      if($request->file('productImage')) {

       
        $file = $request->file('productImage');
        $fileExt = $file->getClientOriginalExtension();
        $newFileName  = $part_no.".".$fileExt;

        $destinationPath = 'uploads';
        $file->move($destinationPath, $newFileName);

        if($is_production == true) {
          // For production 
        
          $basePath = "C:\\xampp\\htdocs\\mis.qmaxonline.com\\uploads\\";
          $source = "C:\\xampp\\htdocs\\mis.qmaxonline.com\\uploads\\".$newFileName;
          $destination = "C:\\nginx\\html\\uploads\\images\\".$newFileName;
       
        } else {
          // For Local Development
        
          $basePath = "C:\\xampp\\htdocs\\qmax\\webadmin\\public\\uploads\\";
          $source = "C:\\xampp\\htdocs\\qmax\\webadmin\\public\\uploads\\".$newFileName;
          $destination = "C:\\nginx\\html\\uploads\\images\\".$newFileName;

        }

        if(file_exists($basePath.$part_no.'.jpg')) {
          if( copy($source, $destination) ) { 
           $op_status = true;
          } else {
            $op_status = false;
          }
        } else { 
          $op_status = false;
        }

      } else {
        $op_status = false;
      }

      $responseStatus = 1; 
      $op_response = array();

      if($op_status == true) {

        Product::where('product_ct_id', $product_ct_id)
        ->update(array(
           'eol' => $eol_status,
           'product_name_customer' => addslashes($productNameCustomer),
           'display_status' => $display_status,
           'product_images' => $newFileName,
           'updated_at' => date("Y-m-d H:i:s")
        )); 

        $op_response = array( 
          "responseStatus" => $responseStatus,
          "op_status" => 1
        );
     

      } else {

        Product::where('product_ct_id', $product_ct_id)
        ->update(array(
           'eol' => $eol_status,
		   'product_name_customer' => addslashes($productNameCustomer),
           'display_status' => $display_status,
           'updated_at' => date("Y-m-d H:i:s")
        )); 

        $op_response = array( 
          "responseStatus" => $responseStatus,
          "op_status" => 1
        );

      }  

      return response()->json($op_response); 

    }

}