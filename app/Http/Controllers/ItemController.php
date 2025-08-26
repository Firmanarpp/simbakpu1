<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Item::with('room');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('brand', 'like', '%'.$search.'%')
                  ->orWhere('type', 'like', '%'.$search.'%')
                  ->orWhere('qr_code', 'like', '%'.$search.'%');
            });
        }

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->input('room_id'));
        }

        $items = $query->paginate(10);
        $rooms = Room::all(); // Get all rooms for the filter dropdown

        return view('items.index', compact('items', 'rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $rooms = Room::all();
        $qrCode = $request->query('qr_code');

        return view('items.create', compact('rooms', 'qrCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Item::create($request->validate([
            'brand' => 'required|string|max:255',
            'qr_code' => 'required|string|unique:items,qr_code',
            'type' => 'required|string|max:255',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'nullable|string'
        ]));
        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $rooms = Room::all();
        return view('items.edit', compact('item', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $item->update($request->validate([
            'brand' => 'required|string|max:255',
            'qr_code' => 'required|string|unique:items,qr_code,' . $item->id,
            'type' => 'required|string|max:255',
            'room_id' => 'required|exists:rooms,id',
            'description' => 'nullable|string'
        ]));
        return redirect()->route('items.index')->with('success', 'Barang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }
}
