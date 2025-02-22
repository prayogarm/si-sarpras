@extends('layouts.app')

@section('content')

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Data Pengembalian</h1>
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
    </div>
  @endif

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th style="width: 15px">NO</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Nama Peminjam</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($pengajuans as $key => $row)     
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $row->barang->kode_barang }}</td>
                        <td>{{ $row->barang->nama_barang }}</td>
                        <td>{{ $row->user->name }}</td>
                        <td>{{ $row->tanggal_pengajuan }}</td>
                        <td>{{ ucfirst($row->status) }}</td>
                        <td style="text-align: center">
                          <div class="d-sm-inline-block">
                            <a class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-toggle="modal" data-target="#addModal{{$row->id}}">
                                <b>Kembalikan</b>
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

@foreach ($pengajuans as $item)
<div class="modal fade" id="addModal{{$item->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ajukan Pengembalian Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group col">
          <label for="title">Nama Barang</label>
          <input type="text" class="form-control" name="nama_barang" required value="{{$item->barang->nama_barang}}" disabled>
        </div>
        <div class="form-group col">
          <label for="title">Kode Barang</label>
          <input type="text" class="form-control" name="kode_barang" required value="{{$item->barang->kode_barang}}" disabled>
        </div>
        <div class="form-group col">
          <label for="title">Tanggal Peminjaman</label>
          <input type="text" class="form-control" name="tanggal_pengajuan" required value="{{$item->tanggal_pengajuan}}" disabled>
        </div>
        <form action="{{ route('pengembalian.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group col">
            <input type="text" class="form-control" name="pengajuan_id" required value="{{$item->id}}" hidden> 
          </div>
          <div class="form-group col">
            <label for="title">Jumlah Pengembalian</label>
            <input type="text" class="form-control" name="jumlah_pinjaman" required value="{{$item->jumlah_pinjaman}}">
          </div>
          <div class="form-group">
            <label class="mt-3">Tanggal Pengembalian</label>
            <input type="date" class="form-control" name="tanggal_pengembalian" required>
          </div>
      </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancle</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
    </div>
  </div>
</div>
@endforeach


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
