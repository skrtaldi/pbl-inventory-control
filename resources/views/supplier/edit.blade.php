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
<form action='{{ url('supplier/'.$supplier->kode) }}' method='post'>
    @csrf
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <a href='{{ url('supplier') }}' class="btn btn-secondary btn-sm"> < Kembali</a>
        <div class="mb-3 row">
            <label for="kode" class="col-sm-2 col-form-label">Kode</label>
            <div class="col-sm-10">
                {{ $supplier->kode }}
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama Supplier</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='nama' value="{{ $supplier->nama }}" id="nama">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jumlah" class="col-sm-2 col-form-label">Nomor</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='jumlah' value="{{ $supplier->nomor }}" id="nomor">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="harga" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name='harga' value="{{ $supplier->alamat }}" id="alamat">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="simpan" class="col-sm-2 col-form-label"></label>
            <div class="col-sm-10"><button type="submit" class="btn btn-primary" name="submit">SIMPAN</button></div>
        </div>
    </div>
</form>
    <!-- AKHIR FORM -->
@endsection