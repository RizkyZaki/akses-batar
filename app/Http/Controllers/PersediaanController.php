<?php

namespace App\Http\Controllers;

use App\Models\PersediaanGudang;
use App\Models\PersediaanPelayanan;
use App\Models\StokKeluar;
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
    $jenisOptions = PersediaanPelayanan::select('jenis')->distinct()->pluck('jenis');
    $namaSediaanOptions = PersediaanPelayanan::select('nama_sediaan')->distinct()->pluck('nama_sediaan');
    $masaBerlakuOptions = PersediaanPelayanan::select('masa_berlaku')->distinct()->pluck('masa_berlaku');
    $type = $request->query('type');
    if ($type === 'rutin') {
      return view('pages.persediaan.gudang.rutin', [
        'title' => 'Persediaan Gudang Rutin',
        'jenisOptions' => $jenisOptions,
        'namaSediaanOptions' => $namaSediaanOptions,
        'masaBerlakuOptions' => $masaBerlakuOptions,
      ]);
    } else {
      return view('pages.persediaan.gudang.program', [
        'title' => 'Persediaan Gudang Program',
        'jenisOptions' => $jenisOptions,
        'namaSediaanOptions' => $namaSediaanOptions,
        'masaBerlakuOptions' => $masaBerlakuOptions,
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
    $jenisOptions = PersediaanPelayanan::select('jenis')->distinct()->pluck('jenis');
    $namaSediaanOptions = PersediaanPelayanan::select('nama_sediaan')->distinct()->pluck('nama_sediaan');
    $masaBerlakuOptions = PersediaanPelayanan::select('masa_berlaku')->distinct()->pluck('masa_berlaku');
    $type = $request->query('type');
    if ($type === 'rutin') {
      return view('pages.persediaan.pelayanan.rutin', [
        'title' => 'Persediaan Pelayanan Rutin',
        'jenisOptions' => $jenisOptions,
        'namaSediaanOptions' => $namaSediaanOptions,
        'masaBerlakuOptions' => $masaBerlakuOptions,
      ]);
    } else {
      return view('pages.persediaan.pelayanan.program', [
        'title' => 'Persediaan Pelayanan Program',
        'jenisOptions' => $jenisOptions,
        'namaSediaanOptions' => $namaSediaanOptions,
        'masaBerlakuOptions' => $masaBerlakuOptions,
      ]);
    }
  }
  public function getDataPelayanan(Request $request)
  {
    $type = $request->query('type');
    $data = PersediaanPelayanan::whereHas('persediaan_gudang', function ($query) use ($type) {
      $query->where('kategori', $type);
    })->with('persediaan_gudang')->latest();

    return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('nama', function ($item) {
        return $item->persediaan_gudang->nama;
      })
      ->addColumn('nama_sediaan', function ($item) {
        return $item->persediaan_gudang->nama_sediaan;
      })
      ->addColumn('satuan', function ($item) {
        return $item->persediaan_gudang->satuan;
      })
      ->addColumn('stok', function ($item) {
        return $item->stok;
      })
      ->addColumn('expired_date', function ($item) {
        return $item->persediaan_gudang->expired_date;
      })
      ->addColumn('expired_status', function ($item) {
        return timeUntil($item->persediaan_gudang->expired_date);
      })
      ->addColumn('expired_class', function ($item) {
        return getTimeUntilClass($item->persediaan_gudang->expired_date);
      })
      ->rawColumns(['expired_status'])
      ->make(true);
  }

  public function pelayananStok(Request $request)
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
    $persediaanPelayanan = PersediaanPelayanan::find(hashidDecode($request->id))->first();
    if ($persediaanPelayanan->stok < $request->stok) {
      return response()->json([
        'status' => 'false',
        'title' => 'Galat',
        'description' => 'Stok Keluar melebihi stok yang tersedia.',
        'icon' => 'error'
      ]);
    }

    $persediaanPelayanan->stok -= $request->stok;
    $persediaanPelayanan->save();

    StokKeluar::create([
      'persediaan_pelayanan_id' => $persediaanPelayanan->id,
      'stok_keluar' => $request->stok
    ]);
    return response()->json([
      'status' => 'true',
      'title' => 'Berhasil',
      'description' => 'Stok berhasil dikurangi dan masuk ke pelayanan.',
      'icon' => 'success'
    ]);
  }

  public function filter(Request $request)
  {
      $query = PersediaanPelayanan::query();

      if ($request->filled('jenis')) {
          $query->whereIn('jenis', $request->input('jenis'));
      }

      if ($request->filled('nama_sediaan')) {
          $query->whereIn('nama_sediaan', $request->input('nama_sediaan'));
      }

      if ($request->filled('masa_berlaku')) {
          $query->whereIn('expired_date', $request->input('masa_berlaku'));
      }

      $results = $query->get();
      $jenisOptions = PersediaanPelayanan::select('jenis')->distinct()->pluck('jenis');
      $namaSediaanOptions = PersediaanPelayanan::select('nama_sediaan')->distinct()->pluck('nama_sediaan');
      $masaBerlakuOptions = PersediaanPelayanan::select('expired_date')->distinct()->pluck('expired_date');
      return view('pages.persediaan.pelayanan.rutin', [
          'title' => 'Persediaan Rutin',
          'jenisOptions' => $jenisOptions,
          'namaSediaanOptions' => $namaSediaanOptions,
          'masaBerlakuOptions' => $masaBerlakuOptions,
          'data' => $results,
      ]);
  }
}