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
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                      <th>NO</th>
                      <th>Nama Barang</th>
                      <th>Kode Barang</th>
                      <th>Kategori</th>
                      <th>Spesifikasi</th>
                      <th>Stok Barang</th>
                      <th>Satuan</th>
                      <th style="width: 140px">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($barangs as $key => $row)     
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ $row->nama_barang }}</td>
                      <td>{{ $row->kode_barang }}</td>
                      <td>{{ $row->kategori }}</td>
                      <td>{{ $row->spesifikasi }}</td>
                      <td>{{ $row->jumlah }}</td>
                      <td>{{ $row->satuan }}</td>
                      <td style="text-align: center">
                          <div class="d-sm-inline-block">
                            <a class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-toggle="modal" data-target="#addModal{{$row->id}}">
                                <b>Pinjam Barang</b>
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
  <!-- DataTales Example -->
  {{-- <div class="card shadow mb-4">
      <div class="card-header py-3">
        <a class="btn btn-sm btn-info card-title m-0" type="button" data-toggle="modal" data-target="#addModal">
          Tambah Data
        </a>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div> --}}
</div>

@foreach ($barangs as $row)
<div class="modal fade" id="addModal{{$row->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Buat Peminjaman Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="row">
            <div class="form-group col">
              <label for="title">Nama Barang</label>
              <input type="text" class="form-control" name="nama_barang" required value="{{$row->nama_barang}}" disabled>
            </div>
            <div class="form-group col">
              <label for="title">Kode Barang</label>
              <input type="text" class="form-control" name="kode_barang" required value="{{$row->kode_barang}}" disabled>
            </div>
            <div class="w-100"></div>
            <div class="form-group col">
              <label for="kategori">Kategori Barang</label>
              <input type="text" class="form-control" name="kategori" required value="{{$row->kategori}}" disabled>
            </div>
            <div class="form-group col">
              <label for="title">Spesifikasi</label>
              <input type="text" class="form-control" name="spesifikasi" required value="{{$row->spesifikasi}}" disabled>
            </div>
            <div class="w-100"></div>
            <div class="form-group col">
              <label for="title">Stok Tersedia</label>
              <input type="text" class="form-control" name="jumlah" required value="{{$row->jumlah}}" disabled>
            </div>
            <div class="form-group col">
              <label for="title">Satuan Barang</label>
              <input type="text" class="form-control" name="satuan" required value="{{$row->satuan}}" disabled>
            </div>
          </div>
          <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control" name="barang_id" required value="{{$row->id}}" required hidden>
            </div>
            <div class="form-group">
              <label for="title">Jumlah Pinjaman</label>
              <input type="number" class="form-control" name="jumlah_pinjaman" min="1" required>
            </div>
            <div class="form-group">
              <label for="title">Tanggal Pengajuan</label>
              <input type="date" class="form-control" name="tanggal_pengajuan" required>
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
