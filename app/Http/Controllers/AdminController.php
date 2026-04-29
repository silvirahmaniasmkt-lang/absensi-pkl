<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\User;

class AdminController extends Controller
{
    // ================= DASHBOARD =================
    public function index(Request $r)
    {
        $query = Absensi::with('user');

        // 🔎 FILTER NAMA
        if ($r->nama) {
            $query->whereHas('user', function ($q) use ($r) {
                $q->where('name', 'like', '%' . $r->nama . '%');
            });
        }

        // 📅 FILTER TANGGAL
        if ($r->from && $r->to) {
            $query->whereBetween('tanggal', [$r->from, $r->to]);
        }

        // 📌 FILTER STATUS
        if ($r->status) {
            $query->where('status', $r->status);
        }

        $data = $query->latest()->get();

        // 📊 STATISTIK
        $totalAbsensi = Absensi::count();
        $hadir = Absensi::where('status', 'hadir')->count();
        $izin = Absensi::where('status', 'izin')->count();
        $sakit = Absensi::where('status', 'sakit')->count();
        $siswa = User::where('role', 'siswa')->count();

        return view('admin.dashboard', compact(
            'data',
            'totalAbsensi',
            'hadir',
            'izin',
            'sakit',
            'siswa'
        ));
    }

    public function dashboard(Request $r)
    {
        return $this->index($r);
    }

    // ================= REKAP =================
    public function rekap(Request $r)
    {
        $query = Absensi::query();

        // 📅 FILTER TANGGAL
        if ($r->from && $r->to) {
            $query->whereBetween('tanggal', [$r->from, $r->to]);
        }

        // 📌 FILTER STATUS (INI YANG KURANG 🔥)
        if ($r->status) {
            $query->where('status', $r->status);
        }

        $data = $query
            ->selectRaw('tanggal, status, count(*) as total')
            ->groupBy('tanggal','status')
            ->orderBy('tanggal','desc')
            ->get();

        return view('admin.rekap', compact('data'));
    }

    // ================= DATA ABSENSI =================
    public function absensi(Request $r)
    {
        $query = Absensi::with('user');

        if($r->nama){
            $query->whereHas('user', function($q) use ($r){
                $q->where('name','like','%'.$r->nama.'%');
            });
        }

        if($r->from && $r->to){
            $query->whereBetween('tanggal', [$r->from, $r->to]);
        }

        if($r->status){
            $query->where('status', $r->status);
        }

        $data = $query->latest()->get();

        return view('admin.absensi', compact('data'));
    }

    // ================= DATA SISWA =================
    public function siswa(Request $r)
    {
        $search = $r->search;

        $data = User::where('role', 'siswa')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
                });
            })
            ->latest()
            ->get();

        return view('admin.siswa', compact('data', 'search'));
    }

    // ================= HAPUS SISWA =================
    public function hapusSiswa($id)
    {
        $user = User::findOrFail($id);
        

        // ❗ cegah admin kehapus
        if ($user->role == 'admin') {
            return back()->with('error', 'Admin tidak bisa dihapus');
        }

        $user->delete();

        return back()->with('success', 'Data siswa berhasil dihapus');
    }

    public function hapusAbsensi($id)
    {
        $data = \App\Models\Absensi::findOrFail($id);
        $data->delete();

        return redirect('/admin/absensi')->with('success', 'Data berhasil dihapus');
    }
}