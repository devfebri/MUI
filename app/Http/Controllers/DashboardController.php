<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ChatSession;
use App\Models\Fatwa;
use App\Models\Konsultasi;
use App\Models\Surat;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard sesuai peran (role) pengguna.
     */
    public function index(): View
    {
        $user = auth()->user();

        // ── STATISTIK SISTEM & OPERASIONAL ──
        $stats = [
            'total_berita' => Berita::count(),
            'berita_published' => Berita::where('status', 'published')->count(),
            'total_views_berita' => (int) Berita::sum('views'),
            'total_surat' => Surat::count(),
            'total_fatwa' => Fatwa::count(),
            'fatwa_published' => Fatwa::where('publikasi', true)->count(),
            'total_views_fatwa' => (int) Fatwa::sum('views'),
            'total_konsultasi' => Konsultasi::count(),
            'konsultasi_pending' => Konsultasi::where('status', 'pending')->count(),
            'konsultasi_dijawab' => Konsultasi::where('status', 'dijawab')->count(),
            'total_chat' => ChatSession::count(),
            'chat_menunggu' => ChatSession::where('status', 'menunggu')->count(),
            'chat_aktif' => ChatSession::where('status', 'aktif')->count(),
            'chat_selesai' => ChatSession::where('status', 'selesai')->count(),
            'total_users' => User::count(),
            'total_admin' => User::where('role', 'admin')->count(),
            'total_operator' => User::where('role', 'operator')->count(),
        ];

        if ($user->isAdmin()) {
            // Data untuk Dashboard Admin
            $latestBerita = Berita::with('user')->latest()->take(5)->get();
            $pendingKonsultasi = Konsultasi::where('status', 'pending')->latest()->take(5)->get();
            $waitingChats = ChatSession::where('status', 'menunggu')->latest()->take(5)->get();
            $activeChats = ChatSession::where('status', 'aktif')->with('operator')->latest()->take(5)->get();
            $latestSurat = Surat::latest()->take(4)->get();
            $latestFatwa = Fatwa::with('kategoriFatwa')->latest()->take(4)->get();
            $operators = User::where('role', 'operator')->orderBy('name')->take(6)->get();

            return view('admin.dashboard', compact(
                'stats',
                'latestBerita',
                'pendingKonsultasi',
                'waitingChats',
                'activeChats',
                'latestSurat',
                'latestFatwa',
                'operators'
            ));
        }

        // Data untuk Dashboard Operator (disesuaikan dengan izin menu yang diberikan)
        $assignedPerms = $user->getAssignedPermissions();
        $operatorData = [];

        if ($user->hasMenuPermission('berita')) {
            $operatorData['my_berita'] = Berita::where('user_id', $user->id)->latest()->take(5)->get();
            $operatorData['my_berita_count'] = Berita::where('user_id', $user->id)->count();
            $operatorData['latest_berita'] = Berita::latest()->take(5)->get();
        }

        if ($user->hasMenuPermission('konsultasi')) {
            $operatorData['pending_konsultasi'] = Konsultasi::where('status', 'pending')->latest()->take(5)->get();
            $operatorData['my_answered_konsultasi'] = Konsultasi::where('penjawab_id', $user->id)->latest()->take(5)->get();
            $operatorData['my_answered_count'] = Konsultasi::where('penjawab_id', $user->id)->count();
        }

        if ($user->hasMenuPermission('livechat')) {
            $operatorData['waiting_chats'] = ChatSession::where('status', 'menunggu')->latest()->take(5)->get();
            $operatorData['my_active_chats'] = ChatSession::where('operator_id', $user->id)->where('status', 'aktif')->latest()->take(5)->get();
            $operatorData['my_active_chats_count'] = ChatSession::where('operator_id', $user->id)->where('status', 'aktif')->count();
        }

        if ($user->hasMenuPermission('surat')) {
            $operatorData['latest_surat'] = Surat::latest()->take(5)->get();
        }

        if ($user->hasMenuPermission('fatwa')) {
            $operatorData['latest_fatwa'] = Fatwa::with('kategoriFatwa')->latest()->take(5)->get();
        }

        return view('operator.dashboard', compact('stats', 'assignedPerms', 'operatorData'));
    }
}
