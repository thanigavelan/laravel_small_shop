<?php

namespace App\Http\Controllers;

use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

use App\Models\Product;
use App\Models\BankDetial;

use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function generateAndSaverProductBarCode($productId)
    {
        $product = Product::findOrFail($productId);
        $barcodePath = $product->generateAndSaverProductBarCode();
        
        return view ('barcode', compact('barcodePath'));
    }
    public function generateAndSaverProductQRCode($bankId)
    {
        $bank = BankDetail::findOrFail($productId);
        $qrcodePath = $bank->generateAndSaverProductQRCode();
        
        return view ('qrcode', compact('qrcodePath'));
    }
}