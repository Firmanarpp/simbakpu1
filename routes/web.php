<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\Auth\LoginController; // Import LoginController
use App\Http\Controllers\Auth\RegisterController; // Import RegisterController
use App\Http\Controllers\AdminController; // Import AdminController
use Illuminate\Support\Facades\Auth; // Import Auth Facade

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    } else {
        return redirect()->route('login');
    }
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Admin Routes (dilindungi oleh middleware auth, Anda mungkin ingin membuat middleware 'admin' kustom)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/verify', [AdminController::class, 'verifyUser'])->name('users.verify');
    Route::put('/users/{user}/unverify', [AdminController::class, 'unverifyUser'])->name('users.unverify');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');
});

// Protected routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/qr-scan', function () {
        return view('qr-scan.index');
    })->name('qr-scan.index');

    Route::post('/qr-scan', function (\Illuminate\Http\Request $request) {
        $qrCode = $request->input('qr_code');
        Log::info('QR Scan Request', ['qr_code' => $qrCode, 'method' => $request->method()]);
        $item = \App\Models\Item::where('qr_code', $qrCode)->first();
        
        if ($item) {
            return redirect()->route('items.show', $item)->with('success', 'Barang ditemukan!');
        } else {
            return redirect()->route('items.create', ['qr_code' => $qrCode])
                    ->with('info', 'QR Code tidak ditemukan. Silakan tambah barang baru dengan kode ini.');
        }
    })->name('qr-scan.scan');

    Route::get('/qr-scan/process', function (\Illuminate\Http\Request $request) {
        $qrCode = $request->query('qr_code');
        if (!$qrCode) {
            return redirect()->route('qr-scan.index')->with('error', 'QR Code tidak valid.');
        }
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
    Route::resource('items', ItemController::class);

    // Rooms routes
    Route::get('/rooms', function () {
        $rooms = \App\Models\Room::withCount('items')->paginate(12);
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
});
