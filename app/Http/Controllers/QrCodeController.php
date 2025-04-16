<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function show()
{
    $url = route('kliens.siswa.create');
    $qr = QrCode::size(300)->generate($url);

    return view('qr.show', compact('qr'));
}
}
