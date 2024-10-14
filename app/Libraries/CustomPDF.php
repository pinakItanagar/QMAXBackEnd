<?php
namespace App\Libraries;

use TCPDF;

class CustomPDF extends TCPDF {
    // Override the Header() method

    protected $topMargins = [];
    
    public function setTopMarginForPage($page, $margin)
    {
        $this->topMargins[$page] = $margin;
    }

    // Override the startPage method to apply the top margin
    public function startPage($orientation = '', $format = '', $tocpage = false)
    {
        parent::startPage($orientation, $format, $tocpage);

        $page = $this->getPage();
        if (isset($this->topMargins[$page])) {
            $this->SetTopMargin($this->topMargins[$page]);
        }
    }
    
    public function Header()
    {
        // Don't call the parent method to prevent the default header content
    }

    public function Footer()
    {
        // Don't call the parent method to prevent the default header content
    }

    public function setPageSize()
    {
       // $this->AddPage('custom', [$width, $height]);
        $this->AddPage('L', array(60, 45));
    }
}


?>