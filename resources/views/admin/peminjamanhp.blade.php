@extends('layouts.app')

@section('content')

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Data  Barang Keluar</h1>
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
    </div>
  @endif

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Peminjaman Barang Habis Pakai</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th style="width: 15px">NO</th>
                        <th>Nama User</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Kategori</th>
                        <th>Status</th>                
                        <th style="width: 140px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($peminjamanhp as $key => $row)     
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $row->user->name}}</td>
                        <td>{{ $row->barang->nama_barang }}</td>
                        <td>{{ $row->tanggal_pengajuan }}</td>
                        <td>{{ $row->barang->kategori }}</td>
                        <td>{{ ucfirst($row->status) }}</td>
                        <td style="text-align: center">
                            @if($row->status == 'pending')
                              <form action="{{ route('admin.peminjaman.approve', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Setujui Peminjaman Barang?');">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                              </form>

                              <form action="{{ route('admin.peminjaman.reject', $row->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Tolak Peminjaman Barang?');">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">Reject</button>
                              </form>
                            @else
                              <div class="d-sm-inline-block">
                                <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#showModal{{$row->id}}">
                                    <i class="fas fa-eye"> </i> Lihat Detail
                                </a>
                              </div>
                              {{-- <form action="{{ route('admin.peminjaman.hapuspeminjaman', $row->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete Data</button>
                              </form> --}}
                            @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>

@foreach ($peminjamanhp as  $row)
<div class="modal fade" id="showModal{{$row->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Lihat Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="title">Nama Peminjam</label>
            <input type="text" class="form-control" disabled value="{{ $row->user->name}}">
          </div>
          <div class="row">
            <div class="form-group col">
              <label for="title">Nama Barang</label>
              <input type="text" class="form-control" disabled value="{{ $row->barang->nama_barang }}">
            </div>
            <div class="form-group col">
              <label for="title">Jumlah</label>
              <input type="text" class="form-control" disabled value="{{ $row->jumlah_pinjaman }}">
            </div>
          </div>
          <div class="form-group">
            <label for="title">Tanggal Peminjaman</label>
            <input type="text" class="form-control" disabled value="{{ $row->tanggal_pengajuan }}">
          </div>
          <div class="form-group">
            <label for="title">Status</label>
            <input type="text" class="form-control" disabled value="{{ ucfirst($row->status) }}" dis>
          </div>
      </div>
          <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
    </div>
  </div>
</div>
@endforeach

@push('script')

@endpush

@endsection
