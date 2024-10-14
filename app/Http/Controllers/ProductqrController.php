<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
//use TCPDF;
use GuzzleHttp\Client;
use QRCode;
use App\Libraries\CustomPDF;

class ProductqrController extends Controller {


    public function generateQR( Request $request )   {

       // echo "<pre>";
       // print_r($request->productList);
       // die();

      
        $arrayProductList = $request->productList ;
        $op_response = array( 
            "response_status" => $arrayProductList,
            "op_status" => 1
        );

        return response()->json($op_response); 

    }

    public function printQR( Request $request )   {

       
        $arrayProductList = explode(",", $request->productList) ;
      
       

         $pdf = new CustomPDF();
           
         // Set document information
         $pdf->SetCreator('QMAX');
         $pdf->SetAuthor('Pinak Pani Nath');
         $pdf->SetTitle('Product QR CODE');
         $pdf->SetSubject('Generates QR code in PDF');
         $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
         $pdf->SetFont('helvetica', '', 28);
         
         
         foreach($arrayProductList as $product) {
            $pdf->AddPage('P', array(200, 200), true, false);
            $pdf->setTopMarginForPage(1, 20);
            $product_data = explode("###", $product);
            $product_part_no = $product_data[0];
            $file_name  = "C:\\xampp\\htdocs\\qmax\\webadmin\\qrcodes\\".$product_data[0].".png";
            $product_name = $product_data[1];
            $img_x = 25;
            $img_y = 15;
            $text_h = 10;

            
            $pdf->Image($file_name, $img_x, $img_y, 150, 160, '', '', 'C', true);

            $pdf->SetXY(20, 160);
            //$pdf->SetXY(20, 120);
            $pdf->Cell(0, $text_h, $product_name, 0,1, 'C');
         }
         
         $pdf_file_name = "document_qr_".$product_part_no.".pdf";
         $pdf_document = "C:\\xampp\\htdocs\\qmax\\webadmin\\public\\downloads\\".$pdf_file_name ;
         $pdf->Output($pdf_document, 'F');

         $op_response = array( 
             "response_status" => $pdf_file_name,
             "op_status" => true
         );
 
         return response()->json($op_response); 
 
     }

    public function testQR() {
       
        $file_name = "qrcodes/testabc123.png" ;
       // $filename = '/qr-code.png';  C01217
       QRCode::text('C01216')
      ->setOutfile($file_name )
      ->png();


      $file_name2 = "qrcodes/testabc1234.png" ;
      // $filename = '/qr-code.png';  C01217
      QRCode::text('C01217')
     ->setOutfile($file_name2 )
     ->png();
        
     
        
      //  $client = new Client();

      // Send GET request to external API
      
      // $response = $client->request('GET', 'http://127.0.0.1/qmax/webadmin/scripts/generateQR.php');

      // Get response body as string
     //  $body = $response->getBody()->getContents();

      // Decode JSON response if necessary
      // $data = json_decode($body, true);

      

          

                // Create a new TCPDF instance
            $pdf = new CustomPDF();
           
            // Set document information
            $pdf->SetCreator('QMAX');
            $pdf->SetAuthor('Pinak Pani Nath');
            $pdf->SetTitle('Product QR CODE');
            $pdf->SetSubject('Generates QR code in PDF');
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            //$pdf->SetMargins(1, 5);
            

            // Add a page
            
            $pdf->SetFont('helvetica', '', 28);
            // Set some content
            $img_x = 25;
            $img_y = 15;
            $text_w = 50;
            $text_h = 10;
 
            $pdf->AddPage('P', array(200, 200), true, false);
            $pdf->Image($file_name, $img_x, $img_y, 150, 160, '', '', 'C', true);
            
            // Set position for text (below the image)
            $textX = 51; // Same X position as the image
            $textY = 160; // Place text below the image, adjust 10 as needed for spacing
            //$pdf->Text($textX, $textY, '711 QMAX 250X375MM (8PCS)');
            $pdf->SetXY(20, 160);
            $pdf->Cell(0, $text_h, 'C01216', 0,1, 'C');


            $pdf->AddPage('P', array(200, 200), true, false);
            $pdf->Image($file_name2, $img_x, $img_y, 150, 160, '', '', 'C', true);
            
            // Set position for text (below the image)
            $textX = 51; // Same X position as the image
            $textY = 160; // Place text below the image, adjust 10 as needed for spacing
            //$pdf->Text($textX, $textY, '711 QMAX 250X375MM (8PCS)');
            $pdf->SetXY(20, 160);
            $pdf->Cell(0, $text_h, 'C01217', 0,1, 'C');



            /*

            $pdf->AddPage('L');
            $pdf->Image($file_name, $img_x, $img_y, 195, 200, '', '', 'C');
            
            // Set position for text (below the image)
            $textX = 46; // Same X position as the image
            $textY = 30; // Place text below the image, adjust 10 as needed for spacing
            $pdf->Text($textX, $textY, '711 QMAX 250X375MM (8PCS)');

          */


            
            
            /*
           
            $pdf->setPageSize(60, 45); 
            $pdf->Image($file_name, $img_x, $img_y, 200, 200, '', '', 'C');
            $pdf->SetXY(0, 10);
            $pdf->Cell($text_w, $text_h, '711 QMAX 250X375MM (8PCS)', 0,1, 'C');
            */
          
            // Output PDF to browser
            $pdf->Output('document.pdf', 'I');
     

    }
}