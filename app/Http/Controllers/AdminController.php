<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Import User model
use Illuminate\Support\Facades\Auth; // Import Auth Facade

class AdminController extends Controller
{
    public function __construct()
    {
        // Hanya izinkan admin untuk mengakses ini. Kita akan membuat middleware ini nanti.
        // Sebagai placeholder, kita asumsikan ada role 'admin' atau cara lain untuk membedakan admin.
        // Untuk POC, kita bisa langsung lanjut, tapi di produksi ini penting.
        // $this->middleware('auth');
        // $this->middleware(function ($request, $next) {
        //     if (!Auth::user()->is_admin) { // Asumsi ada kolom is_admin
        //         abort(403, 'Unauthorized action.');
        //     }
        //     return $next($request);
        // });
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function verifyUser(User $user)
    {
        $user->is_verified = true;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diverifikasi.');
    }

    public function unverifyUser(User $user)
    {
        $user->is_verified = false;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil tidak diverifikasi.');
    }

    public function destroy(User $user)
    {
        // Pastikan admin tidak menghapus dirinya sendiri atau admin lain melalui antarmuka ini
        if ($user->is_admin) {
            return redirect()->route('admin.users.index')->with('error', 'Tidak dapat menghapus akun administrator.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
