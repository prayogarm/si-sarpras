@extends('layouts.dev.app')

@section('header')
<div class="container-fluid">
  <div class="row col-sm-6 mb-2 mt-2">
      <h1>Dashboard</h1>
  </div>
</div>


@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-sm-4 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fa fa-briefcase"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Data Barang</span>
              <span class="info-box-number">5</span>
            </div>
          </div>
        </div>
        
        <div class="col-sm-4 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-book"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Data Transaksi</span>
              <span class="info-box-number">0</span>
            </div>
          </div>
        </div>
        
        <div class="col-sm-4 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Data Pengguna</span>
              <span class="info-box-number">4</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('script')
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush

@endsection

