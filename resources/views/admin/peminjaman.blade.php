@extends('layouts.app')

@section('content')

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Data Peminjaman</h1>
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
    </div>
  @endif

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Peminjaman Barang</h6>
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
                        <th>Status</th>                
                        <th style="width: 140px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($pengajuan as $key => $row)     
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $row->user->name}}</td>
                        <td>{{ $row->barang->nama_barang }}</td>
                        <td>{{ $row->tanggal_pengajuan }}</td>
                        <td>{{ ucfirst($row->status) }}</td>
                        <td style="text-align: center">
                            @if($row->status == 'pending')
                              <form action="{{ route('admin.peminjaman.approve', $row->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                              </form>

                              <form action="{{ route('admin.peminjaman.reject', $row->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">Reject</button>
                              </form>
                            @else
                              <form action="{{ route('admin.peminjaman.hapuspeminjaman', $row->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Delete Data</button>
                              </form>
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

@push('script')

@endpush

@endsection
