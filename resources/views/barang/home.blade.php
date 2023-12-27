<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight" style="font-size: 24px;">
            {{ __('Inventaris Barang') }}
        </h2>
    </x-slot>


    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data Mahasiswa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-hz73PYrJ0+f6LzBFSN7kYNGZl09Ig4i1tjPNKj25E5bDfNYzgRJZp6DaF5gW1L47" crossorigin="anonymous">

    </head>

    <body class="bg-light">
        <main class="container">
            @if (Session::has('success'))
                <div class="pt-3">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
            <!-- START DATA -->
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <!-- TOMBOL TAMBAH DATA -->
                <div class="pb-3" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <p class="fs-4 font-semibold" style="color: rgb(73, 73, 243);">Data Barang</p>
                    </div>
                    <div>
                        <a href="{{ 'admin/create' }}" class="btn btn-primary">+ Tambah Data</a>
                    </div>
                </div>
                <!-- FORM PENCARIAN -->
                <div class="pb-3 d-flex justify-content-end">
                    <form class="d-flex w-70" action="{{ url('admin') }}" method="get">
                        <input class="form-control me-1" type="search" name="katakunci"
                            value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci"
                            aria-label="Search">
                        <button class="btn btn-secondary" type="submit">Cari</button>
                    </form>
                </div>


                <table class="table table-striped">
                    <thead>
                        <tr class="text-center">
                            <th class="col-md-1">No</th>
                            <th class="col-md-1">Kode</th>
                            <th class="col-md-2">Nama Barang</th>
                            <th class="col-md-1">Jumlah</th>
                            <th class="col-md-1">Harga</th>
                            <th class="col-md-2">Supplier</th>
                            <th class="col-md-1">Min Limit</th>
                            <th class="col-md-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = $data->firstItem(); ?>
                        @foreach ($data as $item)
                            <tr class="text-center">
                                <td>{{ $i }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->supplier }}</td>
                                <td>{{ $item->minLimit }}</td>
                                <td>
                                  <div class="text-center d-flex align-items-center">
                                      @if ($item->jumlah <= $item->minLimit)
                                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-exclamation-circle" style="color:red" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                                      </svg>
                                      @elseif ($item->jumlah >= $item->minLimit)
                                      <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-exclamation-circle" style="color: green" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                                      </svg>
                                      @endif
                                        <a href='{{ url('admin/' . $item->kode . '/edit') }}'
                                            class="btn btn-primary btn-sm mx-2">Edit</a>
                                        <form onsubmit="return confirm('Apakah anda yakin ingin menhapus item ini?')"
                                            class='d-inline' action="{{ url('admin/' . $item->kode) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" name="submit"
                                                class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->withQueryString()->links() }}
            </div>
            <!-- AKHIR DATA -->
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
        </script>
    </body>

    </html>
</x-app-layout>
