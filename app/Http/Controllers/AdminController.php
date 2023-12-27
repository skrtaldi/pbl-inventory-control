<?php

namespace App\Http\Controllers;

use App\Charts\JumlahBarangChart;
use App\Http\Controllers\Controller;
use App\Models\Toko;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Customer;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 3;
        if(strlen($katakunci)) {
            $data = Toko::where('nama', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);
        }else {
            $data = Toko::orderBy('kode', 'asc')->Paginate($jumlahbaris);
        }
        return view('barang.home')->with('data', $data);
    }
    
    public function create() 
    {
        $kategori = Kategori::all();
        return view('barang.create',compact('kategori'));
    }

    public function store(Request $request) 
    {
        Session::flash('kode', $request->kode);
        Session::flash('nama', $request->nama);
        Session::flash('jumlah', $request->jumlah);
        Session::flash('harga', $request->harga);
        Session::flash('supplier', $request->supplier);
        Session::flash('minLimit', $request->minLimit);
        Session::flash('maxLimit', $request->maxLimit);
        Session::flash('kategori_kode', $request->kategori_kode);

        $request->validate([
            'kode' => 'required|unique:Toko,kode',
            'nama' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'supplier' => 'required',
            'minLimit' => 'required',
            'maxLimit' => 'required',
            'kategori_kode' => 'required',
        ], [
            'kode.required'=>'Kode wajib diisi',
            'kode.unique'=>'Kode barang sudah ada di dalam data',
            'nama.required'=>'Nama Barang wajib diisi',
            'jumlah.required'=>'Jumlah wajib diisi',
            'harga.required'=>'Harga wajib diisi',
            'supplier.required'=>'Supplier wajib diisi',
            'minLimit.required'=>'Min Limit wajib diisi',
            'maxLimit.required'=>'Max Limit wajib diisi',
            'kategori_kode.required'=>'Kategori wajib diisi',
        ]);
        $data = [
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'jumlah'=>$request->jumlah,
            'harga'=>$request->harga,
            'supplier'=>$request->supplier,
            'minLimit'=>$request->minLimit,
            'maxLimit'=>$request->maxLimit,
            'kategori_kode'=>$request->kategori_kode,
        ];
        Toko::create($data);
       return redirect()->to('barang')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id) 
    {
        $kategori = Kategori::all();
        $data = Toko::where('kode', $id)->first();
        return view('barang.edit', compact('kategori'))->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jumlah' => 'required',
            'harga' => 'required',
            'supplier' => 'required',
            'minLimit' => 'required',
            'maxLimit' => 'required',
            'kategori_kode' => 'required',
        ], [
            'nama.required'=>'Nama Barang wajib diisi',
            'jumlah.required'=>'Jumlah wajib diisi',
            'harga.required'=>'Harga wajib diisi',
            'supplier.required'=>'Supplier wajib diisi',
            'minLimit.required'=>'Min Limit wajib diisi',
            'maxLimit.required'=>'Max Limit wajib diisi',
            'kategori_kode.required'=>'Kategori wajib diisi',
        ]);
        $data = [
            'nama'=>$request->nama,
            'jumlah'=>$request->jumlah,
            'harga'=>$request->harga,
            'supplier'=>$request->supplier,
            'minLimit'=>$request->minLimit,
            'maxLimit'=>$request->maxLimit,
            'kategori_kode'=>$request->kategori_kode,
        ];
        Toko::where('kode', $id)->update($data);
       return redirect()->to('admin')->with('success', 'Berhasil melakukan update data produk');
    }

    public function destroy($id)
    {
        Toko::where('kode', $id)->delete();
        return redirect()->to('admin')->with('success', 'Berhasil menghapus data produk');
    }

    public function barang(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 2;
        if(strlen($katakunci)) {
            $data = Toko::where('nama', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);
        }else {
            $data = Toko::orderBy('kode', 'asc')->Paginate($jumlahbaris);
        }
        return view('barang.barang')->with('data', $data);
    }
}
