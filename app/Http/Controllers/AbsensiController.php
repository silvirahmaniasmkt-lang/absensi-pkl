<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function dashboard(){
        $data = Absensi::where('user_id',auth()->id())->latest()->get();
        $today = Absensi::where('user_id',auth()->id())
            ->whereDate('tanggal',date('Y-m-d'))->exists();

        return view('siswa.dashboard',compact('data','today'));
    }

    public function formMasuk(){
        return view('siswa.absen_masuk');
    }

    public function formPulang(){
        return view('siswa.absen_pulang');
    }

    public function masuk(Request $r){

    if(Absensi::where('user_id',auth()->id())
        ->whereDate('tanggal',date('Y-m-d'))->exists()){
        return back()->with('error','Sudah absen');
    }

    // ⏰ ambil jam sekarang
    $jamSekarang = now();

    // 🎯 tentukan status
    if($jamSekarang->format('H:i') > '08:00'){
        $status = 'terlambat';
    }else{
        $status = 'hadir';
    }

    Absensi::create([
        'user_id'=>auth()->id(),
        'tanggal'=>date('Y-m-d'),
        'jam_masuk'=>$jamSekarang,
        'status'=>$status,
        'keterangan'=>$r->keterangan
    ]);

    return redirect('/dashboard')->with('success','Absen masuk berhasil');
}

    public function pulang(Request $r){
        $data = Absensi::where('user_id',auth()->id())
            ->whereDate('tanggal',date('Y-m-d'))->first();

        if(!$data){
            return back()->with('error','Belum absen masuk');
        }

        $data->update([
            'jam_pulang'=>now(),
            'keterangan_pulang'=>$r->keterangan_pulang
        ]);

        return redirect('/dashboard')->with('success','Absen pulang berhasil');
    }

    public function riwayat(){
        $data = Absensi::where('user_id',auth()->id())->get();
        return view('siswa.riwayat',compact('data'));
    }

    public function rekap(){
        $hadir = Absensi::where('user_id',auth()->id())->where('status','hadir')->count();
        $izin = Absensi::where('user_id',auth()->id())->where('status','izin')->count();
        $sakit = Absensi::where('user_id',auth()->id())->where('status','sakit')->count();

        return view('siswa.rekap',compact('hadir','izin','sakit'));
    }
}