@extends('layouts.app')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Konsumsi</h1>
        <a href="{{ route('konsumsis.create') }}" class="btn btn-primary">Add Sarpras</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Jenis Konsumsi</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Anggaran</th>
                <th>Harga</th>
                <th>Pajak</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @if($konsumsi->count() > 0)
            @foreach($konsumsi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td> <!-- Mengganti $key + 1 dengan $loop->iteration -->
                    <td>{{ $item->jenis_konsumsi }}</td>
                    <td>{{ $item->tanggal_pengadaan }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->anggaran }}</td>
                    <td>{{ $item->harga }}</td>
                    <td>{{ $item->pajak }}</td>
                    <td>{{ $item->total }}</td>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('konsumsis.show', $item->id) }}" type="button" class="btn btn-secondary">Detail</a>
                            <a href="{{ route('konsumsis.edit', $item->id)}}" type="button" class="btn btn-warning">Edit</a>
                            <form action="{{ route('konsumsis.destroy', $item->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger m-0">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td class="text-center" colspan="8">Konsumsi not found</td>
            </tr>
        @endif

        </tbody>
    </table>
@endsection
