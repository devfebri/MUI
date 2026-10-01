<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Fatwa;
use App\Models\Konsultasi;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Tampilkan halaman utama (welcome) dengan data dinamis real-time dari database.
     */
    public function index(Request $request): View
    {
        // 1. Data Berita
        $allBeritas = Berita::where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->take(20)
            ->get();

        // Fallback jika belum ada berita berstatus published
        if ($allBeritas->isEmpty()) {
            $allBeritas = Berita::orderByDesc('created_at')->take(20)->get();
        }

        $tickerBeritas = $allBeritas->take(8);
        $beritaUtama = $allBeritas->first();
        $beritaLeft = $allBeritas->slice(1, 4);
        $beritaMiddlePrimary = $allBeritas->slice(5, 1)->first() ?? $allBeritas->skip(1)->first();
        $beritaMiddleList = $allBeritas->slice(6, 4);
        if ($beritaMiddleList->isEmpty() && $allBeritas->count() > 1) {
            $beritaMiddleList = $allBeritas->slice(2, 4);
        }
        // Berita terpopuler berdasarkan jumlah dilihat
        $beritaPopuler = Berita::where('status', 'published')
            ->orderByDesc('views')
            ->orderByDesc('published_at')
            ->take(5)
            ->get();

        if ($beritaPopuler->isEmpty()) {
            $beritaPopuler = $allBeritas->take(5);
        }

        $beritaTerkini = $allBeritas->take(4);

        // Berita kategori Khutbah / Bimbingan
        $beritaKhutbah = Berita::where('status', 'published')
            ->whereIn('kategori', ['Khutbah', 'Bimbingan', 'Tuntunan Ibadah'])
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        if ($beritaKhutbah->isEmpty()) {
            $beritaKhutbah = $allBeritas->take(3);
        }

        // 2. Data Fatwa
        $fatwaTerbaru = Fatwa::where('publikasi', 1)
            ->with('kategori')
            ->latest('created_at')
            ->take(6)
            ->get();

        if ($fatwaTerbaru->isEmpty()) {
            $fatwaTerbaru = Fatwa::with('kategori')->latest('created_at')->take(6)->get();
        }

        $fatwaCards = $fatwaTerbaru->take(3);
        $sidebarFatwas = $fatwaTerbaru->take(5);

        // 3. Statistik Ringkas
        $totalBerita = Berita::count();
        $totalFatwa = Fatwa::where('publikasi', 1)->count();
        $totalKonsultasi = Konsultasi::count();
        $totalSurat = Surat::count();

        return view('welcome', compact(
            'tickerBeritas',
            'beritaUtama',
            'beritaLeft',
            'beritaMiddlePrimary',
            'beritaMiddleList',
            'beritaPopuler',
            'beritaTerkini',
            'beritaKhutbah',
            'fatwaCards',
            'sidebarFatwas',
            'totalBerita',
            'totalFatwa',
            'totalKonsultasi',
            'totalSurat'
        ));
    }
}
