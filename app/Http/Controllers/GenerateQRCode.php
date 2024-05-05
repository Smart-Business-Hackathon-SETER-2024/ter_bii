<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class GenerateQRCode extends Controller
{
    public function generate()
    {
        $qrCode = QrCode::size(200)->generate('Données à encoder dans le QR Code');
        return response($qrCode)->header('Content-type', 'image/png');
    }
}
