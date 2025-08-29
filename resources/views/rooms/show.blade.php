{{--
/**
 * Room Detail Page - Halaman Detail Ruangan
 * 
 * File: resources/views/rooms/show.blade.php
 * Deskripsi: Halaman untuk menampilkan detail ruangan dan barang di dalamnya
 * Fitur: Room info sidebar, items list, action buttons, delete protection
 * 
 * Komponen yang ditampilkan:
 * - Page header dengan nama ruangan dan deskripsi
 * - Navigation button (Kembali saja, Edit dipindah ke sidebar)
 * - Sidebar dengan informasi ruangan dan aksi:
 *   - Info ruangan (nama, lantai, total barang)
 *   - Action buttons (Edit, Tambah Barang, Scan QR, Hapus)
 * - Main content dengan daftar barang di ruangan
 * - Delete confirmation modal dengan validasi
 * 
 * @author Sistem Manajemen Barang KPU
 * @version 1.0
 * @since August 2025
 */
--}}
@extends('layouts.app') {{-- Menggunakan layout aplikasi utama --}}

@section('title', 'Detail Ruangan - ' . $room->name) {{-- Mengatur judul halaman dengan nama ruangan --}}

@section('content') {{-- Memulai bagian konten utama --}}
{{-- Bagian Header Halaman --}}
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                {{-- Judul halaman: Nama Ruangan --}}
                <h1 class="mb-0">
                    <i class="fas fa-door-open me-3"></i>
                    {{ $room->name }}
                </h1>
                {{-- Deskripsi singkat ruangan (lantai dan deskripsi) --}}
                <p class="lead mb-0">
                    @if($room->floor) {{-- Menampilkan lantai jika ada --}}
                        <i class="fas fa-building me-1"></i>{{ $room->floor }}
                    @endif
                    @if($room->floor && $room->description) • @endif {{-- Pemisah jika ada lantai dan deskripsi --}}
                    @if($room->description) {{-- Menampilkan deskripsi jika ada --}}
                        {{ Str::limit($room->description, 100) }}
                    @endif
                </p>
            </div>
            {{-- Tombol Kembali ke daftar ruangan --}}
            <div class="col-auto">
                <a href="{{ route('rooms.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        {{-- Kolom Sidebar Informasi Ruangan --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Ruangan
                    </h6>
                </div>
                <div class="card-body">
                    {{-- Ikon ruangan besar di tengah --}}
                    <div class="text-center mb-3">
                        <div class="display-4 text-warning">
                            <i class="fas fa-door-open"></i>
                        </div>
                    </div>
                    
                    {{-- Tabel detail informasi ruangan --}}
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td class="fw-bold text-muted">Nama:</td>
                            <td>{{ $room->name }}</td>
                        </tr>
                        @if($room->floor) {{-- Menampilkan baris lantai jika ada --}}
                            <tr>
                                <td class="fw-bold text-muted">Lantai:</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-building me-1"></i>{{ $room->floor }}
                                    </span>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="fw-bold text-muted">Total Barang:</td>
                            <td>
                                <span class="badge bg-primary fs-6">
                                    {{ $room->items->count() }} barang
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Dibuat:</td>
                            <td>
                                {{ $room->created_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $room->created_at->diffForHumans() }}</small>
                            </td>
                        </tr>
                    </table>
                    
                    @if($room->description) {{-- Menampilkan deskripsi lengkap jika ada --}}
                        <div class="border-top pt-3 mt-3">
                            <h6 class="fw-bold text-muted mb-2">Deskripsi:</h6>
                            <p class="text-muted">{{ $room->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- Card Aksi --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Aksi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        {{-- Tombol Edit Ruangan --}}
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit Ruangan
                        </a>
                        
                        {{-- Tombol Tambah Barang di Ruangan Ini --}}
                        <a href="{{ route('items.create', ['room_id' => $room->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Barang di Ruangan Ini
                        </a>
                        
                        {{-- Tombol Cetak Daftar Barang --}}
                        <button type="button" class="btn btn-info" onclick="printRoomItems()">
                            <i class="fas fa-print me-2"></i>
                            Cetak Daftar Barang
                        </button>
                        
                        {{-- Tombol Scan QR Code --}}
                        <a href="{{ route('qr-scan.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-qrcode me-2"></i>
                            Scan QR Code
                        </a>
                        
                        <hr>
                        
                        {{-- Tombol Hapus Ruangan (kondisional: hanya bisa dihapus jika tidak ada barang) --}}
                        @if($room->items->count() == 0)
                            <button type="button" 
                                    class="btn btn-outline-danger"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal">
                                <i class="fas fa-trash me-2"></i>
                                Hapus Ruangan
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-secondary" disabled>
                                <i class="fas fa-trash me-2"></i>
                                Tidak dapat dihapus (ada barang)
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Kolom utama untuk daftar barang di ruangan ini --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0">
                                <i class="fas fa-box me-2"></i>
                                Barang di Ruangan Ini ({{ $room->items->count() }})
                            </h6>
                        </div>
                        {{-- Tombol Tambah Barang (langsung ke ruangan ini) --}}
                        <div class="col-auto">
                            <a href="{{ route('items.create', ['room_id' => $room->id]) }}" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Barang
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($room->items->count() > 0) {{-- Jika ada barang di ruangan ini --}}
                        {{-- Tabel responsif untuk daftar barang --}}
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>QR Code</th>
                                        <th>Merk</th>
                                        <th>Tipe</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($room->items as $index => $item) {{-- Loop untuk setiap barang --}}
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <code class="bg-light p-1 rounded">{{ $item->qr_code }}</code>
                                            </td>
                                            <td><strong>{{ $item->brand }}</strong></td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                @if($item->description) {{-- Menampilkan deskripsi barang (dibatasi 40 karakter) --}}
                                                    <span class="text-muted">{{ Str::limit($item->description, 40) }}</span>
                                                @else
                                                    <span class="text-muted font-italic">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- Grup tombol aksi (Lihat dan Edit) --}}
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('items.show', $item->id) }}" 
                                                       class="btn btn-outline-primary btn-sm"
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('items.edit', $item->id) }}" 
                                                       class="btn btn-outline-warning btn-sm"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else {{-- Jika tidak ada barang di ruangan ini --}}
                        {{-- Tampilan kosong dan tombol untuk menambahkan barang --}}
                        <div class="text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Belum ada barang di ruangan ini</h6>
                            <p class="text-muted">Mulai dengan menambahkan barang pertama untuk ruangan {{ $room->name }}.</p>
                            <div class="mt-3">
                                <a href="{{ route('items.create', ['room_id' => $room->id]) }}" 
                                   class="btn btn-primary me-2">
                                    <i class="fas fa-plus me-1"></i>Tambah Barang
                                </a>
                                <a href="{{ route('qr-scan.index') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-qrcode me-1"></i>Scan QR Code
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus (hanya ditampilkan jika ruangan tidak memiliki barang) --}}
@if($room->items->count() == 0)
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Konfirmasi Hapus Ruangan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{-- Peringatan bahwa tindakan tidak dapat dibatalkan --}}
                <div class="alert alert-danger">
                    <h6><i class="fas fa-warning me-2"></i>Peringatan!</h6>
                    <p class="mb-0">Tindakan ini tidak dapat dibatalkan. Ruangan akan dihapus secara permanen dari sistem.</p>
                </div>
                
                <p>Apakah Anda yakin ingin menghapus ruangan <strong>{{ $room->name }}</strong>?</p>
                
                {{-- Detail ruangan yang akan dihapus --}}
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td class="fw-bold" style="width: 30%;">Nama:</td>
                                <td>{{ $room->name }}</td>
                            </tr>
                            @if($room->floor)
                                <tr>
                                    <td class="fw-bold">Lantai:</td>
                                    <td>{{ $room->floor }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="fw-bold">Total Barang:</td>
                                <td>{{ $room->items->count() }} barang</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- Tombol Batal --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                {{-- Form untuk mengirim permintaan DELETE --}}
                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline">
                    @csrf {{-- Token CSRF untuk keamanan form --}}
                    @method('DELETE') {{-- Metode DELETE untuk menghapus resource --}}
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus Ruangan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection {{-- Mengakhiri bagian konten utama --}}

@push('scripts') {{-- Memulai bagian JavaScript --}}
<script>
// Fungsi untuk mencetak daftar barang di ruangan ini
function printRoomItems() {
    const roomName = '{{ $room->name }}';
    const roomFloor = '{{ $room->floor }}';
    const roomDescription = '{{ $room->description ? Str::limit($room->description, 100) : '' }}';
    const items = @json($room->items);

    let itemsTableHtml = '';
    if (items.length > 0) {
        // Membuat tabel HTML untuk daftar barang jika ada
        itemsTableHtml = `
            <h3>Daftar Barang</h3>
            <table class="print-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>QR Code</th>
                        <th>Merk</th>
                        <th>Tipe</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
        `;
        items.forEach((item, index) => {
            itemsTableHtml += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.qr_code}</td>
                    <td>${item.brand}</td>
                    <td>${item.type}</td>
                    <td>${item.description ? item.description.substring(0, 50) + (item.description.length > 50 ? '...' : '') : '-'}</td>
                </tr>
            `;
        });
        itemsTableHtml += `
                </tbody>
            </table>
        `;
    } else {
        itemsTableHtml = '<p>Tidak ada barang di ruangan ini.</p>'; // Pesan jika tidak ada barang
    }

    const printWindow = window.open('', '_blank'); // Membuka jendela baru untuk cetak
    if (printWindow) {
        printWindow.document.write(`
            <html>
                <head>
                    <title>Daftar Barang Ruangan: ${roomName}</title>
                    <style>
                        body { 
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
                            padding: 20px; 
                            color: #333;
                            line-height: 1.6;
                        }
                        .header { 
                            text-align: center; 
                            margin-bottom: 30px; 
                            border-bottom: 2px solid #8f0000; 
                            padding-bottom: 10px;
                        }
                        .header h1 { 
                            color: #8f0000; 
                            margin: 0; 
                            font-size: 28px;
                        }
                        .room-info { 
                            margin-bottom: 20px; 
                            border: 1px solid #eee; 
                            padding: 15px; 
                            border-radius: 8px;
                            background-color: #f9f9f9;
                        }
                        .room-info p { margin: 0 0 5px 0; }
                        .print-table { 
                            width: 100%; 
                            border-collapse: collapse; 
                            margin-top: 20px; 
                        }
                        .print-table th, .print-table td { 
                            border: 1px solid #ddd; 
                            padding: 8px; 
                            text-align: left; 
                            font-size: 14px;
                        }
                        .print-table th { 
                            background-color: #8f0000; 
                            color: white; 
                            font-weight: bold;
                        }
                        .print-table tbody tr:nth-child(even) { 
                            background-color: #f2f2f2; 
                        }
                        .footer { 
                            text-align: center; 
                            margin-top: 40px; 
                            font-size: 12px; 
                            color: #777;
                        }
                        @media print {
                            body { margin: 0; }
                            .header, .room-info, .print-table, .footer { 
                                page-break-inside: avoid; 
                                page-break-after: auto; 
                            }
                            @page { margin: 1cm; }
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>Daftar Barang Ruangan</h1>
                        <p>Sistem Manajemen Barang KPU JATENG</p>
                    </div>
                    <div class="room-info">
                        <p><strong>Nama Ruangan:</strong> ${roomName}</p>
                        ${roomFloor ? '<p><strong>Lantai:</strong> ' + roomFloor + '</p>' : ''} {{-- Menampilkan lantai jika ada --}}
                        ${roomDescription ? '<p><strong>Deskripsi:</strong> ' + roomDescription + '</p>' : ''} {{-- Menampilkan deskripsi jika ada --}}
                    </div>
                    ${itemsTableHtml}
                    <div class="footer">
                        Dicetak pada: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}
                    </div>
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    } else {
        showToast('Gagal membuka jendela cetak.', 'error'); // Menampilkan pesan error jika gagal membuka jendela cetak
    }
}
</script>
@endpush {{-- Mengakhiri bagian JavaScript --}}
