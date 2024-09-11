@extends('layouts.dev.app')

@section('header')
<div class="container-fluid">
  <div class="row col-sm-6 mb-2 mt-2">
      <h1>Data Peminjaman</h1>
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
                  <td>{{ $row->status }}</td>
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
