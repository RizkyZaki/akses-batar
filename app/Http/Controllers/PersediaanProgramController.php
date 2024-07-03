<?php

namespace App\Http\Controllers;

use App\Models\PersediaanProgram;
use App\Models\PersediaanRutin;
use Illuminate\Http\Request;

class PersediaanProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenisOptions = PersediaanProgram::select('program')->distinct()->pluck('program');
        $namaSediaanOptions = PersediaanProgram::select('nama_sediaan')->distinct()->pluck('nama_sediaan');
        $masaBerlakuOptions = PersediaanProgram::select('expired_date')->distinct()->pluck('expired_date')->map(function ($date) {
            return timeUntil($date);
        });
        return view('pages.persediaan-program.index', [
            'title' => 'Persediaan Program',
            'jenisOptions' => $jenisOptions,
            'namaSediaanOptions' => $namaSediaanOptions,
            'masaBerlakuOptions' => $masaBerlakuOptions,
            'data' => PersediaanProgram::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.persediaan-program.create', [
            'title' => 'Tambah Persediaan Program',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'program' => 'required',
            'nama_sediaan' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'expired_date' => 'required',
        ], [
            'program.required' => 'program Wajib Diisi',
            'nama_sediaan.required' => 'Nama Sediaan Wajib Diisi',
            'stok.required' => 'Stok Wajib Diisi',
            'satuan.required' => 'Satuan Wajib Diisi',
            'expired_date.required' => 'Tanggal Kadaluarsa Wajib Diisi',
        ]);
        $data = [
            'program' => $request->program,
            'nama_sediaan' => $request->nama_sediaan,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'expired_date' => $request->expired_date,
        ];
        PersediaanProgram::create($data);
        notify()->success('Data Berhasil Dimasukkan');
        return redirect('dashboard/persediaan-program');
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
        $data = PersediaanProgram::find(hashidDecode($id))->first();
        return view('pages.persediaan-program.update', [
            'title' => 'Persediaan Program',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'program' => 'required',
            'nama_sediaan' => 'required',
            'satuan' => 'required',
            'stok' => 'required',
            'expired_date' => 'required',
        ], [
            'program.required' => 'program Wajib Diisi',
            'nama_sediaan.required' => 'Nama Sediaan Wajib Diisi',
            'stok.required' => 'Stok Wajib Diisi',
            'satuan.required' => 'Satuan Wajib Diisi',
            'expired_date.required' => 'Tanggal Kadaluarsa Wajib Diisi',
        ]);

        $persediaanProgram = PersediaanProgram::find(hashidDecode($id))->first();

        $data = [
            'program' => $request->program,
            'nama_sediaan' => $request->nama_sediaan,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'expired_date' => $request->expired_date,
        ];
        $persediaanProgram->update($data);

        notify()->success('Data Berhasil Diupdate');

        return redirect('dashboard/persediaan-program');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $persediaanProgram = PersediaanProgram::find(hashidDecode($id))->first();

        $persediaanProgram->delete();

        notify()->success('Data Berhasil Dihapus');

        return redirect('dashboard/persediaan-program');
    }
    public function filter(Request $request)
    {
        $query = PersediaanProgram::query();

        if ($request->filled('program')) {
            $query->whereIn('program', $request->input('program'));
        }

        if ($request->filled('nama_sediaan')) {
            $query->whereIn('nama_sediaan', $request->input('nama_sediaan'));
        }

        if ($request->filled('masa_berlaku')) {
            $query->whereIn('expired_date', $request->input('masa_berlaku'));
        }

        $results = $query->get();
        $jenisOptions = PersediaanProgram::select('program')->distinct()->pluck('program');
        $namaSediaanOptions = PersediaanProgram::select('nama_sediaan')->distinct()->pluck('nama_sediaan');
        $masaBerlakuOptions = PersediaanProgram::select('expired_date')->distinct()->pluck('expired_date');
        return view('pages.persediaan-rutin.index', [
            'title' => 'Persediaan Rutin',
            'jenisOptions' => $jenisOptions,
            'namaSediaanOptions' => $namaSediaanOptions,
            'masaBerlakuOptions' => $masaBerlakuOptions,
            'data' => $results,
        ]);
    }
}