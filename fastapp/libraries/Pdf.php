<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . '../vendor/autoload.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf
{
    protected $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $this->dompdf = new Dompdf($options);
    }

       public function create($html, $filename = 'document.pdf', $stream = true)
    {
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper('A4', 'portrait');
        $this->dompdf->render();
    
        // Prevent buffer corruption
        if (ob_get_length()) {
            ob_end_clean();
        }
    
        if ($stream) {
            $this->dompdf->stream($filename, ["Attachment" => false]);
        } else {
            return $this->dompdf->output();
        }
    }

  public function generate($html, $filename = 'document.pdf',$stream = true,$paper = 'A4', $orientation = 'portrait')
    {

        //$dompdf = new Dompdf(options );
        $this->dompdf->loadHtml($html);
        $this->dompdf->setPaper($paper,$orientation);
        $this->dompdf->render();
        if (ob_get_length()) {
            ob_end_clean();
        }
        //$this->dompdf->stream($filename, ["Attachment" => $stream]);
        if ($stream) {
            $output = $this->dompdf->output();
            $savePath = FCPATH . 'uploads/invoices/' . $filename;
            if (!is_dir(dirname($savePath))) {
                mkdir(dirname($savePath), 0755, true);
            }
            file_put_contents($savePath, $output);
            $this->dompdf->stream($filename, ["Attachment" => $stream]);
        } else {
            $this->dompdf->stream($filename, ["Attachment" => $stream]);
            
        }
    }

}


