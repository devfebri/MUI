<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BeritaController extends Controller
{
    private const KATEGORI = [
        'Berita Utama',
        'Fatwa',
        'Bimbingan',
        'Halal',
        'Khutbah',
        'Opini',
        'Nasional',
        'Internasional',
        'Ekonomi',
        'Teknologi',
        'Sosial',
        'Kabar Daerah',
    ];

    /**
     * Tampilkan daftar berita (DataTables JSON atau view).
     */
    public function index(Request $request): mixed
    {
        if ($request->ajax()) {
            return $this->datatableResponse($request);
        }

        return view('berita.index');
    }

    /**
     * Form tambah berita (halaman penuh).
     */
    public function create(): View
    {
        return view('berita.create', [
            'kategoriList' => self::KATEGORI,
        ]);
    }

    /**
     * Simpan berita baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:' . implode(',', self::KATEGORI),
            'isi' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['judul']);
        $validated['published_at'] = $validated['status'] === 'published'
            ? ($validated['published_at'] ?? now())
            : null;

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        Berita::create($validated);

        return redirect()->route(auth()->user()->role . '.berita.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Form edit berita (halaman penuh).
     */
    public function edit(Berita $berita): View
    {
        return view('berita.edit', [
            'berita' => $berita,
            'kategoriList' => self::KATEGORI,
        ]);
    }

    /**
     * Simpan perubahan berita.
     */
    public function update(Request $request, Berita $berita): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:' . implode(',', self::KATEGORI),
            'isi' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'hapus_gambar' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['judul']);
        $validated['published_at'] = $validated['status'] === 'published'
            ? ($validated['published_at'] ?? $berita->published_at ?? now())
            : null;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar) {
                \Storage::disk('public')->delete($berita->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        } elseif ($request->boolean('hapus_gambar') && $berita->gambar) {
            \Storage::disk('public')->delete($berita->gambar);
            $validated['gambar'] = null;
        }

        $berita->update($validated);

        return redirect()->route(auth()->user()->role . '.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita (AJAX).
     */
    public function destroy(Berita $berita): JsonResponse
    {
        if ($berita->gambar) {
            \Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return response()->json([
            'message' => 'Berita berhasil dihapus.',
        ]);
    }

    /* ── Private ──────────────────────────────────────── */

    private function datatableResponse(Request $request): JsonResponse
    {
        $query = Berita::with('penulis:id,name')->select('beritas.*');

        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('kategori', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $total = Berita::count();
        $filtered = $query->count();

        $orderCol = (int) $request->input('order.0.column', 6);
        $orderDir = $request->input('order.0.dir', 'desc');
        $cols = ['id', 'judul', 'kategori', 'status', 'published_at', 'penulis', 'created_at'];
        $col = $cols[$orderCol] ?? 'created_at';

        if ($col !== 'penulis') {
            $query->orderBy("beritas.{$col}", $orderDir);
        }

        $start = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);
        $data = $query->skip($start)->take($length)->get();

        return response()->json([
            'draw' => (int) $request->input('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $data,
        ]);
    }

    public function list()
    {
        return view('berita.list');
    }
}
