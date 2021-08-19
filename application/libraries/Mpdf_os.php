
<?php

    defined('BASEPATH') OR exit('Ação não permitida');

    require_once __DIR__ . '/vendor_mpdf/autoload.php';

    use \Mpdf\Mpdf;

    class Mpdf_os
    {
        public function criarPDF($html, $file_name)
        {
            $mpdf = new Mpdf();
            $mpdf->WriteHTML($html, $file_name);
            $mpdf->Output($file_name, 'D');
        }
    }    

?>