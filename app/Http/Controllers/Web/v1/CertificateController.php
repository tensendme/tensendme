<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 28.02.2020
 * Time: 23:14
 */

namespace App\Http\Controllers\Web\v1;


use App\Http\Controllers\WebBaseController;


class CertificateController extends WebBaseController
{


    public function getCertificate()
    {
        $certificate = 'Сертификат #124312';
        $middleText = 'об участии на курсе «Cымбатты мүсін»';
        $given = 'ВЫДАЕТСЯ';
        $fullName = 'БЕКЗАТ БЕКМУРАТОВ АЗАМАТУЛЫ';
        $author = 'АСКАР К. Б.';
        $infoText = 'Сайт рыбатекст поможет дизайнеру,
                верстальщику, вебмастеру сгенерировать
                несколько абзацев более менее
                осмысленного текста рыбы на русском языке';
        return view('pdf_view', compact('certificate', 'middleText', 'given', 'fullName', 'infoText', 'author'));
    }
}
