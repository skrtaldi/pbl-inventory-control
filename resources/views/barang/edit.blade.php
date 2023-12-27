@extends('layouts.template')

@section('content')

@if($errors->any())
    <div class="pt-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $errors)
                    <li>{{ $errors }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
<!-- START FORM -->
<form action='{{ url('admin/'.$data->kode) }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{ url('admin') }}' class="btn btn-secondary btn-sm"> < Kembali</a>
        <div class="mb-3 row">
            <label for="kode" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
                {{ $data->kode }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{ $data->nama }}" id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jumlah' value="{{ $data->jumlah }}" id="jumlah">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">Harga</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='harga' value="{{ $data->harga }}" id="harga">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="supplier" class="col-sm-2 col-form-label">Supplier</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='supplier' value="{{ $data->supplier }}" id="supplier">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="supplier" class="col-sm-2 col-form-label">Min Limit</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='minLimit' value="{{ $data->minLimit }}" id="minLimit">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="supplier" class="col-sm-2 col-form-label">Max Limit</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name='maxLimit' value="{{ $data->maxLimit }}" id="maxlimit">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
            <select name="kategori_kode" value="{{ Session::get('kategori') }}" class="form-control">
                <option value="" class="text-center">--- Pilih ---</option>
                @foreach ($kategori as $item)
                <option value="{{ $item->kode }}" class="text-center">{{ $item->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 row">
            <label for="jurusan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
    <!-- AKHIR FORM -->
@endsection