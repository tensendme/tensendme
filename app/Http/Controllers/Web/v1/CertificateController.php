<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 28.02.2020
 * Time: 23:14
 */

namespace App\Http\Controllers\Web\v1;


use App\Http\Controllers\WebBaseController;
use setasign\Fpdi\Tcpdf\Fpdi;


class CertificateController extends WebBaseController
{


    public function getCertificate2()
    {
        $certificate = 'Сертификат';
        $id = 'ID #124312';
        $middleText = 'об участии на курсе «Cымбатты мүсін»';
        $given = 'ВЫДАЕТСЯ';
        $fullName = 'БЕКЗАТ БЕКМУРАТОВ АЗАМАТУЛЫ';
        $author = 'АСКАР К. Б.';
        $infoText = 'Сайт рыбатекст поможет дизайнеру,
                верстальщику, вебмастеру сгенерировать
                несколько абзацев более менее
                осмысленного текста рыбы на русском языке';
        return view('pdf_view', compact('certificate', 'middleText', 'given', 'fullName', 'infoText', 'author', 'id'));
    }

    public function getCertificate()
    {

        $pdf = new Fpdi('L', 'mm', 'A4');
        $pdf->setSourceFile(public_path('certificate.pdf'));
        $fontName = "DejaVuSans";
        $pdf->AddFont($fontName, '', 'DejaVuSans.php');
        $pdf->AddFont($fontName, 'B', 'DejaVuSans.php');
        $pdf->AddFont($fontName, 'I', 'DejaVuSans.php');
        $tplId = $pdf->importPage(1);
        $pdf->addPage();

        $pdf->useTemplate($tplId, 0, 0);
        $pdf->SetMargins(0, 0, 0, 0);
        $pdf->SetAutoPageBreak(false);

        $pdf->SetFont($fontName, '', '20');
        $pdf->SetTextColor(60, 60, 60);
        $pdf->SetXY(100, 95);
        $this->Cell($pdf, 100, 10, strtoupper(" - ға"), 0, 0, 'C');
        $pdf->SetFont($fontName, '', '20');
        $pdf->SetXY(100, 102);
        $this->Cell($pdf, 100, 10, "\"\" - курсын", 0, 0, 'C');

        $pdf->SetXY(100, 110);
        $this->Cell($pdf, 100, 10, "сәтті аяқтағаны үшін беріледі", 0, 0, 'C');

        $pdf->SetFont($fontName, 'B', '20');
        $pdf->SetXY(100, 120);
        $this->Cell($pdf, 100, 10, "ҚҰТТЫҚТАЙМЫЗ!", 0, 0, 'C');

        $pdf->SetFont($fontName, 'B', '10');
        $pdf->SetXY(100, 170);
        $this->Cell($pdf, 100, 10, "СЕРТИФИКАТ НӨМІРІ: ", 0, 0, 'C');
        $pdf->SetXY(100, 178);
        $this->Cell($pdf, 100, 10, "ТАПСЫРҒАН УАҚЫТЫ: ", 0, 0, 'C');

        return $pdf->Output("certificate.pdf", "I", true);
    }

    function Cell($pdf, $w, $h, $txt, $b, $i, $a)
    {
        $pdf->Cell($w, $h, ($txt), $b, $i, $a);
    }

}
