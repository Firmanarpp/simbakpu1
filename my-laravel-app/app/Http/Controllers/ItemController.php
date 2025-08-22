<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Room;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::with('room')->paginate(10);
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $rooms = Room::all();
        $qrCode = $request->input('qr_code');
        return view('items.create', compact('rooms', 'qrCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'qr_code' => 'required|string|unique:items,qr_code',
            'type' => 'required|string|max:255',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'nullable|string'
        ]);

        Item::create($validated);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::with('room')->findOrFail($id);
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        $rooms = Room::all();
        return view('items.edit', compact('item', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);
        
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'qr_code' => 'required|string|unique:items,qr_code,' . $id,
            'type' => 'required|string|max:255',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'nullable|string'
        ]);

        $item->update($validated);

        return redirect()->route('items.show', $item->id)->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }
}
