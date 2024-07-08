<?php

namespace App\Http\Controllers;

use App\Models\Formularium;
use Illuminate\Http\Request;

class FormulariumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelasTerapiOptions = Formularium::select('kelas_terapi')->distinct()->pluck('kelas_terapi');
        $subKelasTerapiOptions = Formularium::select('sub_kelas_terapi')->distinct()->pluck('sub_kelas_terapi');
        $namaSediaanOptions = Formularium::select('nama_sediaan')->distinct()->pluck('nama_sediaan');
        return view('pages.formularium.index', [
            'title' => 'Formularium',
            'kelasTerapiOptions' => $kelasTerapiOptions,
            'subKelasTerapiOptions' => $subKelasTerapiOptions,
            'namaSediaanOptions' => $namaSediaanOptions,
            'data' => Formularium::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.formularium.create', [
            'title' => 'Tambah Formularium',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_terapi' => 'required',
            'sub_kelas_terapi' => 'required',
            'nama_sediaan' => 'required',
        ], [
            'kelas_terapi.required' => 'Kelas Terapi Wajib Diisi',
            'sub_kelas_terapi.required' => 'Sub Kelas Terapi Wajib Diisi',
            'nama_sediaan.required' => 'Nama Sediaan Wajib Diisi',
        ]);
    
        $data = $request->all();
        if (empty($data['keterangan'])) {
            $data['keterangan'] = '-';
        }
        if (empty($data['peresepan_maksimal'])) {
            $data['peresepan_maksimal'] = '-';
        }
    
        Formularium::create($data);
        notify()->success('Data Berhasil Dimasukkan');
        return redirect('dashboard/formularium');
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
        $data = Formularium::find(hashidDecode($id))->first();
        return view('pages.formularium.update', [
            'title' => 'Formularium',
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kelas_terapi' => 'required',
            'sub_kelas_terapi' => 'required',
            'nama_sediaan' => 'required',
            'peresepan_maksimal' => 'required',
        ], [
            'kelas_terapi.required' => 'Kelas Terapi Wajib Diisi',
            'sub_kelas_terapi.required' => 'Sub Kelas Terapi Wajib Diisi',
            'nama_sediaan.required' => 'Nama Sediaan Wajib Diisi',
            'peresepan_maksimal.required' => 'Peresepan Maksimal Wajib Diisi',
        ]);
        
        $formularium = Formularium::find(hashidDecode($id))->first();

        $data = $request->all();
        if (empty($data['keterangan'])) {
            $data['keterangan'] = '-';
        }
        if (empty($data['peresepan_maksimal'])) {
            $data['peresepan_maksimal'] = '-';
        }
    
        $formularium->update($data);
        notify()->success('Data Berhasil Diupdate');
        return redirect('dashboard/formularium');
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $formularium = Formularium::find(hashidDecode($id))->first();

        $formularium->delete();
        
        notify()->success('Data Berhasil Dihapus');

        return redirect('dashboard/formularium');
    }

    public function filter(Request $request)
    {
        $query = Formularium::query();

        if ($request->filled('kelas_terapi')) {
            $query->whereIn('kelas_terapi', $request->input('kelas_terapi'));
        }

        if ($request->filled('sub_kelas_terapi')) {
            $query->whereIn('sub_kelas_terapi', $request->input('sub_kelas_terapi'));
        }

        if ($request->filled('nama_sediaan')) {
            $query->whereIn('nama_sediaan', $request->input('nama_sediaan'));
        }

        $results = $query->get();
        $kelasTerapiOptions = Formularium::select('kelas_terapi')->distinct()->pluck('kelas_terapi');
        $subKelasTerapiOptions = Formularium::select('sub_kelas_terapi')->distinct()->pluck('sub_kelas_terapi');
        $namaSediaanOptions = Formularium::select('nama_sediaan')->distinct()->pluck('nama_sediaan');

        return view('pages.formularium.index', [
            'title' => 'Formularium',
            'kelasTerapiOptions' => $kelasTerapiOptions,
            'subKelasTerapiOptions' => $subKelasTerapiOptions,
            'namaSediaanOptions' => $namaSediaanOptions,
            'data' => $results,
        ]);
    }
}