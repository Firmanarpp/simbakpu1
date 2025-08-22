<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/qr-scan', function () {
    return view('qr-scan.index');
})->name('qr-scan.index');

Route::post('/qr-scan', function (\Illuminate\Http\Request $request) {
    $qrCode = $request->input('qr_code');
    
    // Log untuk debugging
    Log::info('QR Scan Request', ['qr_code' => $qrCode, 'method' => $request->method()]);
    
    $item = \App\Models\Item::where('qr_code', $qrCode)->first();
    
    if ($item) {
        return redirect()->route('items.show', $item)->with('success', 'Barang ditemukan!');
    } else {
        return redirect()->route('items.create', ['qr_code' => $qrCode])
                ->with('info', 'QR Code tidak ditemukan. Silakan tambah barang baru dengan kode ini.');
    }
})->name('qr-scan.scan');

// Also handle GET request for fallback
Route::get('/qr-scan/process', function (\Illuminate\Http\Request $request) {
    $qrCode = $request->query('qr_code');
    
    if (!$qrCode) {
        return redirect()->route('qr-scan.index')->with('error', 'QR Code tidak valid.');
    }
    
    // Log untuk debugging
    Log::info('QR Scan GET Request', ['qr_code' => $qrCode]);
    
    $item = \App\Models\Item::where('qr_code', $qrCode)->first();
    
    if ($item) {
        return redirect()->route('items.show', $item)->with('success', 'Barang ditemukan!');
    } else {
        return redirect()->route('items.create', ['qr_code' => $qrCode])
                ->with('info', 'QR Code tidak ditemukan. Silakan tambah barang baru dengan kode ini.');
    }
})->name('qr-scan.process');

Route::post('/qr-scan/search', function (\Illuminate\Http\Request $request) {
    $qrCode = $request->input('qr_code');
    $item = \App\Models\Item::where('qr_code', $qrCode)->first();
    
    if ($item) {
        return response()->json([
            'success' => true,
            'message' => 'Barang ditemukan!',
            'item' => $item->load('room'),
            'redirect' => route('items.show', $item)
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'QR Code tidak ditemukan dalam database.'
        ]);
    }
})->name('qr-scan.search');

// Items routes
Route::get('/items', function () {
    $items = \App\Models\Item::with('room')->paginate(10);
    return view('items.index', compact('items'));
})->name('items.index');

Route::get('/items/create', function (\Illuminate\Http\Request $request) {
    $rooms = \App\Models\Room::all();
    $qrCode = $request->query('qr_code'); // Get QR code from query parameter
    
    return view('items.create', compact('rooms', 'qrCode'));
})->name('items.create');

Route::post('/items', function (\Illuminate\Http\Request $request) {
    \App\Models\Item::create($request->validate([
        'brand' => 'required|string|max:255',
        'qr_code' => 'required|string|unique:items,qr_code',
        'type' => 'required|string|max:255',
        'room_id' => 'required|exists:rooms,id',
        'description' => 'nullable|string'
    ]));
    return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
})->name('items.store');

Route::get('/items/{item}', function (\App\Models\Item $item) {
    return view('items.show', compact('item'));
})->name('items.show');

Route::get('/items/{item}/edit', function (\App\Models\Item $item) {
    $rooms = \App\Models\Room::all();
    return view('items.edit', compact('item', 'rooms'));
})->name('items.edit');

Route::put('/items/{item}', function (\Illuminate\Http\Request $request, \App\Models\Item $item) {
    $item->update($request->validate([
        'brand' => 'required|string|max:255',
        'qr_code' => 'required|string|unique:items,qr_code,' . $item->id,
        'type' => 'required|string|max:255',
        'room_id' => 'required|exists:rooms,id',
        'description' => 'nullable|string'
    ]));
    return redirect()->route('items.index')->with('success', 'Barang berhasil diupdate!');
})->name('items.update');

Route::delete('/items/{item}', function (\App\Models\Item $item) {
    $item->delete();
    return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
})->name('items.destroy');

// Rooms routes
Route::get('/rooms', function () {
    $rooms = \App\Models\Room::withCount('items')->paginate(10);
    return view('rooms.index', compact('rooms'));
})->name('rooms.index');

Route::get('/rooms/create', function () {
    return view('rooms.create');
})->name('rooms.create');

Route::post('/rooms', function (\Illuminate\Http\Request $request) {
    \App\Models\Room::create($request->validate([
        'name' => 'required|string|max:255',
        'floor' => 'required|string|max:255',
        'description' => 'nullable|string'
    ]));
    return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil ditambahkan!');
})->name('rooms.store');

Route::get('/rooms/{room}', function (\App\Models\Room $room) {
    $room->load('items');
    return view('rooms.show', compact('room'));
})->name('rooms.show');

Route::get('/rooms/{room}/edit', function (\App\Models\Room $room) {
    return view('rooms.edit', compact('room'));
})->name('rooms.edit');

Route::put('/rooms/{room}', function (\Illuminate\Http\Request $request, \App\Models\Room $room) {
    $room->update($request->validate([
        'name' => 'required|string|max:255',
        'floor' => 'required|string|max:255',
        'description' => 'nullable|string'
    ]));
    return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil diupdate!');
})->name('rooms.update');

Route::delete('/rooms/{room}', function (\App\Models\Room $room) {
    if ($room->items()->count() > 0) {
        return redirect()->route('rooms.index')->with('error', 'Tidak dapat menghapus ruangan yang masih berisi barang!');
    }
    $room->delete();
    return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil dihapus!');
})->name('rooms.destroy');
