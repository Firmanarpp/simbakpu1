<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Room;
use Illuminate\Http\Request;

class QRScanController extends Controller
{
    public function index()
    {
        return view('qr-scan.index');
    }

    public function scan(Request $request)
    {
        $qrCode = $request->input('qr_code');
        
        // Cari barang berdasarkan QR code
        $item = Item::where('qr_code', $qrCode)->first();
        
        if ($item) {
            // Jika barang ditemukan, redirect ke halaman detail
            return redirect()->route('items.show', $item->id);
        } else {
            // Jika barang tidak ditemukan, redirect ke halaman tambah barang dengan QR code
            return redirect()->route('items.create', ['qr_code' => $qrCode]);
        }
    }
}
