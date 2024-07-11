<?php

namespace App\Http\Controllers;

use App\Models\PersediaanGudang;
use App\Models\PersediaanPelayanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PersediaanController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(Request $request)
  {
    $type = $request->query('type');
    if ($type === 'rutin') {
      return view('pages.persediaan.gudang.rutin', [
        'title' => 'Persediaan Gudang Rutin',
      ]);
    } else {
      return view('pages.persediaan.gudang.program', [
        'title' => 'Persediaan Gudang Program',
      ]);
    }
  }
  public function getData(Request $request)
  {
    $type = $request->query('type');
    $data = PersediaanGudang::where('kategori', $type)->latest();

    return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('expired_status', function ($item) {
        return timeUntil($item->expired_date);
      })
      ->addColumn('expired_class', function ($item) {
        return getTimeUntilClass($item->expired_date);
      })
      ->rawColumns(['expired_status'])
      ->make(true);
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'nama_sediaan' => 'required',
      'satuan' => 'required',
      'stok' => 'required',
      'expired_date' => 'required',
    ], [
      'name.required' => 'Kolom Wajib Diisi wajib diisi.',
      'nama_sediaan.required' => 'Nama Sediaan wajib diisi.',
      'satuan.required' => 'Satuan wajib diisi.',
      'stok.required' => 'Stok wajib diisi.',
      'expired_date.required' => 'Tanggal Kadaluarsa wajib diisi.',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors()->all();

      return response()->json([
        'status' => 'false',
        'title' => 'Galat',
        'description' => $errors[0],
        'icon' => 'error'
      ]);
    }

    $data = [
      'nama' => $request->name,
      'satuan' => $request->satuan,
      'stok' => $request->stok,
      'expired_date' => $request->expired_date,
      'nama_sediaan' => $request->nama_sediaan,
      'expired_date' => $request->expired_date,
      'kategori' => $request->kategori
    ];

    PersediaanGudang::create($data);

    return response()->json([
      'status' => 'true',
      'title' => 'Berhasil',
      'description' => 'Data Berhasil Dibuat',
      'icon' => 'success'
    ]);
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
    $data = PersediaanGudang::find(hashidDecode($id))->first();
    if ($data) {
      return response()->json([
        'status' => 'true',
        'data' => $data
      ]);
    } else {
      return response()->json([
        'status' => 'false'
      ]);
    }
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'nama_sediaan' => 'required',
      'satuan' => 'required',
      'stok' => 'required',
      'expired_date' => 'required',
    ], [
      'name.required' => 'Kolom Wajib Diisi wajib diisi.',
      'nama_sediaan.required' => 'Nama Sediaan wajib diisi.',
      'satuan.required' => 'Satuan wajib diisi.',
      'stok.required' => 'Stok wajib diisi.',
      'expired_date.required' => 'Tanggal Kadaluarsa wajib diisi.',
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors()->all();

      return response()->json([
        'status' => 'false',
        'title' => 'Galat',
        'description' => $errors[0],
        'icon' => 'error'
      ]);
    }

    $data = [
      'nama' => $request->name,
      'satuan' => $request->satuan,
      'stok' => $request->stok,
      'expired_date' => $request->expired_date,
      'nama_sediaan' => $request->nama_sediaan,
      'expired_date' => $request->expired_date,
      'kategori' => $request->kategori
    ];

    PersediaanGudang::find($id)->update($data);

    return response()->json([
      'status' => 'true',
      'title' => 'Berhasil',
      'description' => 'Data Berhasil Diubah',
      'icon' => 'success'
    ]);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    $data = PersediaanGudang::find(hashidDecode($id))->first();
    if ($data) {
      $data->delete();

      return response()->json([
        'status' => 'true',
        'title' => 'Berhasil',
        'description' => 'Data Berhasil Dihapus',
        'icon' => 'success',
      ]);
    } else {
      return response()->json([
        'status' => 'false',
        'title' => 'Error',
        'description' => 'Data Tidak Ditemukan',
        'icon' => 'error',
      ]);
    }
  }
  public function gudangStok(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'stok' => 'required',
    ], [
      'stok.required' => 'Stok Keluar wajib diisi.',
    ]);
    if ($validator->fails()) {
      $errors = $validator->errors()->all();

      return response()->json([
        'status' => 'false',
        'title' => 'Galat',
        'description' => $errors[0],
        'icon' => 'error'
      ]);
    }
    $persediaanGudang = PersediaanGudang::find(hashidDecode($request->id))->first();
    if ($persediaanGudang->stok < $request->stok) {
      return response()->json([
        'status' => 'false',
        'title' => 'Galat',
        'description' => 'Stok Keluar melebihi stok yang tersedia.',
        'icon' => 'error'
      ]);
    }

    $persediaanGudang->stok -= $request->stok;
    $persediaanGudang->save();

    PersediaanPelayanan::create([
      'persediaan_gudang_id' => $persediaanGudang->id,
      'stok' => $request->stok
    ]);
    return response()->json([
      'status' => 'true',
      'title' => 'Berhasil',
      'description' => 'Stok berhasil dikurangi dan masuk ke pelayanan.',
      'icon' => 'success'
    ]);
  }
  public function pelayanan(Request $request)
  {
    $type = $request->query('type');
    if ($type === 'rutin') {
      return view('pages.persediaan.pelayanan.rutin', [
        'title' => 'Persediaan Pelayanan Rutin',
      ]);
    } else {
      return view('pages.persediaan.pelayanan.program', [
        'title' => 'Persediaan Pelayanan Program',
      ]);
    }
  }
}
