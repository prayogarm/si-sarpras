@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
    </div>
  
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 py-3 border-left-info">
                <div class="card-body">
                    <label style="color: black; font-weight:bold;">Nama Pengguna</label>
                    <h4 style="padding-bottom: 8px">{{Auth::user()->name}}</h4>
                    <label style="color: black; font-weight:bold;">Kelas / Jurusan</label>
                    <h4 style="padding-bottom: 8px">{{Auth::user()->kelas}}</h4>
                    <label style="color: black; font-weight:bold;">Email</label>
                    <h4>{{Auth::user()->email}}</h4>
                    <label style="color: black; font-weight:bold;">Roles</label>
                    <h4>{{ Auth::user()->roles->first()->name }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection