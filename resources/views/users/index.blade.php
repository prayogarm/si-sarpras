@extends('layouts.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Data Pengguna</h1>
  @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>	
      <strong>{{ $message }}</strong>
    </div>
  @endif

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <a class="btn btn-sm btn-primary m-0 font-weight-bold text-light" href="{{route('users.create')}}">Tambah Pengguna</a>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                        <th style="width: 15px">NO</th>
                        <th>Nama Pengguna</th>
                        <th>Kelas</th>
                        <th>Username</th>
                        <th>Peran</th>
                        <th style="width: 140px">Action</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $key => $row)     
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->kelas }}</td>
                        <td>{{ $row->email }}</td>
                        <td>
                            @if(!empty($row->getRoleNames()))
                              @foreach($row->getRoleNames() as $v)
                                <label>{{ $v }}</label>
                              @endforeach
                            @endif
                        </td>
                        <td style="text-align: center">
                            <div class="d-sm-inline-block">
                              <a class="btn btn-primary btn-sm" href="{{route('users.edit',$row->id)}}">
                                  <i class="fas fa-pen"></i>
                              </a>
                            </div>

                            <div class="d-sm-inline-block">
                              <form action="{{route('users.destroy',$row->id)}}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i></button>
                              </form>
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

{{-- <div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Pengguna</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Nama Lengkap</label>
            <input type="text" class="form-control" name="name" required>
          </div>
          <div class="form-group">
            <label for="title">Email</label>
            <input type="text" class="form-control" name="email" required>
          </div>
          <div class="form-group">
            <label for="title">Password</label>
            <input type="text" class="form-control" name="password" required>
          </div>
          <div class="form-group">
            <label for="title">Konfirmasi Password</label>
            <input type="text" class="form-control" name="confirm-password" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Peran</label>
              <select class="form-control" id="exampleFormControlSelect1">
                @foreach ($roles as $item)
                  <option name="roles">{{$item->name}}</option>
                @endforeach
              </select>
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

<!-- Edit Modal -->
@foreach ($products as $row)
<div class="modal fade" id="editModal{{$row->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Gedung</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('products.update', $row->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="title">Nama Gedung</label>
            <input type="text" class="form-control" name="name" required value="{{$row->name}}">
          </div>
      </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
    </div>
  </div>
</div>  --}}

<!-- Delete Modal -->
{{-- <div class="modal fade" id="deleteModal{{$row->id}}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Pengguna</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('users.destroy', $row->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('DELETE')

          <p>Yakin ingin menghapus data ini?</p>

      </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancle</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
    </div>
  </div>
</div> 
@endforeach --}}

@push('script')
<script>
  
</script>
@endpush

@endsection
