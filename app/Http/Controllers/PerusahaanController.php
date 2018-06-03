<?php

namespace App\Http\Controllers;

use App\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perusahaan = Perusahaan::with('Member')->get();
        return view('perusahaan.index',compact('perusahaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = Member::all();
        return view('perusahaan.create',compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'logo' => 'required|',
            'deskripsi' => 'required|max:255',
            'kategori' => 'required|max:115',
            'subkategori' => 'required|max:115',
            'judul' => 'required|max:50',
            'gaji' => 'required|number',
            'tanggal_mulai' => 'required|',
            'email' => 'required|unique:perusahaans',
            'telepon' => 'required|',
            'user_id' => 'required|unique:members'
        ]);
        $perusahaan = new Perusahaan;
        $perusahaan->logo = $request->logo;
        $perusahaan->deskripsi = $request->deskripsi;
        $perusahaan->kategori = $request->kategori;
        $perusahaan->subkategori = $request->subkategori;
        $perusahaan->judul = $request->judul;
        $perusahaan->gaji = $request->gaji;
        $perusahaan->tanggal_mulai = $request->tanggal_mulai;
        $perusahaan->email = $request->email;
        $perusahaan->telepon = $request->telepon;
        $perusahaan->user_id = $request->user_id;
        
        $perusahaan->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$perusahaan->logo</b>"
        ]);
        return redirect()->route('perusahaan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function show(Perusahaan $perusahaan)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        return view('perusahaan.show',compact('perusahaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perusahaan $perusahaan)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $user = User::all();
        $selectedus = Perusahaan::findOrFail($id)->user_id;
        // dd($selected);
        return view('perusahaan.edit',compact('perusahaan','user','selectedus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perusahaan $perusahaan)
    {
        $this->validate($request,[
            'logo' => 'required|',
            'deskripsi' => 'required|max:255',
            'kategori' => 'required|max:115',
            'subkategori' => 'required|max:115',
            'judul' => 'required|max:50',
            'gaji' => 'required|',
            'tanggal_mulai' => 'required|',
            'email' => 'required|',
            'telepon' => 'required|',
            'user_id' => 'required|unique:members'
        ]);
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->logo = $request->logo;
        $perusahaan->deskripsi = $request->deskripsi;
        $perusahaan->kategori = $request->kategori;
        $perusahaan->subkategori = $request->subkategori;
        $perusahaan->judul = $request->judul;
        $perusahaan->gaji = $request->gaji;
        $perusahaan->tanggal_mulai = $request->tanggal_mulai;
        $perusahaan->email = $request->email;
        $perusahaan->telepon = $request->telepon;
        $perusahaan->user_id = $request->user_id;
        $perusahaan->save();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil mengedit <b>$perusahaan->logo</b>"
        ]);
        return redirect()->route('perusahaan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perusahaan  $perusahaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perusahaan $perusahaan)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Data Berhasil dihapus"
        ]);
        return redirect()->route('perusahaan.index');
    }
}
