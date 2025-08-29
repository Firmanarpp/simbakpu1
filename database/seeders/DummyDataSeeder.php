<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Item;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear existing data (optional, be careful in production)
        // Item::truncate();
        // Room::truncate();

        // Create some dummy rooms
        $room1 = Room::create([
            'name' => 'Ruang Server',
            'floor' => 'Lantai 1',
            'description' => 'Ruangan untuk server dan perangkat jaringan utama',
        ]);

        $room2 = Room::create([
            'name' => 'Ruang Rapat',
            'floor' => 'Lantai 2',
            'description' => 'Ruangan untuk pertemuan dan diskusi',
        ]);

        $room3 = Room::create([
            'name' => 'Gudang Arsip',
            'floor' => 'Lantai 1',
            'description' => 'Tempat penyimpanan dokumen dan arsip lama',
        ]);

        // Create some dummy items
        Item::create([
            'brand' => 'Dell',
            'type' => 'Server PowerEdge',
            'description' => 'Server untuk hosting aplikasi KPU',
            'qr_code' => 'KPU-SRV-001',
            'room_id' => $room1->id,
        ]);

        Item::create([
            'brand' => 'HP',
            'type' => 'Laptop Pavilion',
            'description' => 'Laptop inventaris untuk staf',
            'qr_code' => 'KPU-LPT-002',
            'room_id' => $room2->id,
        ]);

        Item::create([
            'brand' => 'Epson',
            'type' => 'Printer L3110',
            'description' => 'Printer multifungsi di ruang staf',
            'qr_code' => 'KPU-PRN-003',
            'room_id' => $room2->id,
        ]);

        Item::create([
            'brand' => 'Panasonic',
            'type' => 'Proyektor PT-VW360',
            'description' => 'Proyektor untuk presentasi di ruang rapat',
            'qr_code' => 'KPU-PRJ-004',
            'room_id' => $room2->id,
        ]);

        Item::create([
            'brand' => 'Cisco',
            'type' => 'Router Catalyst',
            'description' => 'Router utama untuk jaringan kantor',
            'qr_code' => 'KPU-RTR-005',
            'room_id' => $room1->id,
        ]);
    }
}
