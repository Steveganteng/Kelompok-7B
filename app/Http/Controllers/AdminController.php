<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Obat;
use App\Models\AlatKesehatan;
use App\Models\ProdukKesehatan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get counts for Pasien, Obat, Alat Kesehatan, and Produk Kesehatan
        $pasienCount = Pasien::count();
        $obatCount = Obat::count();
        $alatKesehatanCount = AlatKesehatan::count();
        $produkKesehatanCount = ProdukKesehatan::count();

      // Get Obat with stock < 150 and Tanggal Kadaluarsa within 2 months
        $obats = Obat::where('stok', '<', 150)
                     ->where('tgl_kadaluarsa', '<=', Carbon::now()->addMonths(2))
                     ->get()
                     ->map(function ($obat) {
                         // Calculate how many days left until the expiration date
                         $obat->days_until_expiration = Carbon::parse($obat->tgl_kadaluarsa)->diffInDays(Carbon::now());

                         // Add a human-readable message
                         $obat->expiration_message = $obat->days_until_expiration . ' days left until expiration';

                         return $obat;
                     });

        // Pass data to view
        return view('admin.dashboard_admin', [
            'pasienCount' => $pasienCount,
            'obatCount' => $obatCount,
            'alatKesehatanCount' => $alatKesehatanCount,
            'produkKesehatanCount' => $produkKesehatanCount,
            'obats' => $obats,
        ]);
    }
}
