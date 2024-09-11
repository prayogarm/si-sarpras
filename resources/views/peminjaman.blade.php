@extends('layouts.dev.app')

@section('header')
<div class="container-fluid">
  <div class="row col-sm-6 mb-2 mt-2">
      <h1>Data Peminjaman Barang</h1>
  </div>
</div>
@endsection

@section('content')

<div class="container">
  <div class="row"> 
    <div class="col-lg-12">
      @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
        </div>
      @endif
      <div class="card card-defalt card-outline">
        <div class="card-header">
          <a class="btn btn-sm btn-info card-title m-0" type="button" data-toggle="modal" data-target="#addModal">
            Tambah Data
          </a>
        </div>
                        
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 15px">NO</th>
                <th>Nama Barang</th>
                <th>Nama Peminjam</th>
                <th>Tanggal Pengajuan</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pengajuans as $key => $row)     
                <tr>
                  <td>{{ ++$key }}</td>
                  <td>{{ $row->barang->nama_barang }}</td>
                  <td>{{ $row->user->name }}</td>
                  <td>{{ $row->tanggal_pengajuan }}</td>
                  <td>{{ ucfirst($row->status) }}</td>
                  <td style="text-align: center">
                      <div class="d-sm-inline-block">
                        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#editModal{{$row->id}}">
                            <i class="fas fa-pen"></i>
                        </a>
                      </div>

                      <div class="d-sm-inline-block">
                        <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteModal{{$row->id}}">
                            <i class="fas fa-trash"></i>
                        </a>
                      </div>
                  </td>
                </tr>
              @endforeach
            </tbody> 
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Buat Pengajuan Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('pengajuann.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <select name="barang_id" id="barang_id" class="form-control" required>
            <option value="">-- Pilih Barang --</option>
            @foreach($barangs as $barang)
                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
            @endforeach
          </select>
          <div class="form-group">
            <label for="title">Tanggal Pengajuan</label>
            <input type="text" class="form-control" name="tanggal_pengajuan" required>
          </div>
      </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>



@push('script')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush

@endsection
