<?php

namespace App\Http\Controllers;

use App\Models\PersediaanRutin;
use Illuminate\Http\Request;

class PersediaanRutinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.persediaan-rutin.index', [
            'title' => 'Persediaan Rutin',
            'data' => PersediaanRutin::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.persediaan-rutin.create', [
            'title' => 'Tambah Persediaan rutin',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'nama_sediaan' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'expired_date' => 'required',
        ], [
            'jenis.required' => 'Jenis Wajib Diisi',
            'nama_sediaan.required' => 'Nama Sediaan Wajib Diisi',
            'stok.required' => 'Stok Wajib Diisi',
            'satuan.required' => 'Satuan Wajib Diisi',
            'expired_date.required' => 'Tanggal Kadaluarsa Wajib Diisi',
        ]);
        $data = [
            'jenis' => $request->jenis,
            'nama_sediaan' => $request->nama_sediaan,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'expired_date' => $request->expired_date,
        ];
        PersediaanRutin::create($data);
        notify()->success('Data Berhasil Dimasukkan');
        return redirect('dashboard/persediaan-rutin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = PersediaanRutin::find(hashidDecode($id))->first();
        return view('pages.persediaan-rutin.update', [
            'title' => 'Persediaan rutin',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required',
            'nama_sediaan' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'expired_date' => 'required',
        ], [
            'jenis.required' => 'Jenis Wajib Diisi',
            'nama_sediaan.required' => 'Nama Sediaan Wajib Diisi',
            'stok.required' => 'Stok Wajib Diisi',
            'satuan.required' => 'Satuan Wajib Diisi',
            'expired_date.required' => 'Tanggal Kadaluarsa Wajib Diisi',
        ]);

        $persediaanRutin = PersediaanRutin::find(hashidDecode($id))->first();

        $data = [
            'jenis' => $request->jenis,
            'nama_sediaan' => $request->nama_sediaan,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'expired_date' => $request->expired_date,
        ];
        $persediaanRutin->update();

        notify()->success('Data Berhasil Diupdate');

        return redirect('dashboard/persediaan-rutin');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $persediaanRutin = PersediaanRutin::find(hashidDecode($id))->first();

        $persediaanRutin->delete();

        notify()->success('Data Berhasil Dihapus');

        return redirect('dashboard/persediaan-rutin');
    }
}