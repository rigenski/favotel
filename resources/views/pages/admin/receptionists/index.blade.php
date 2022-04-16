@extends('layouts.admin')
@section('receptionists', 'active')

@section('title', 'Daftar Resepsionis')

@section('content')
<div class="card mb-4">
  <div class="card-header row">
    <div class="col-12 col-sm-6 p-0 my-1">
      <div class="d-flex align-items-start">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
          Tambah
        </button>
      </div>
    </div>
    <div class="col-12 col-sm-6 p-0 my-1">
      <div class="d-flex align-items-end flex-column">
        @if(session('success'))
        <div class="alert alert-success p-1 px-4 m-0">
          {{ session('success') }}
        </div>
        @elseif(session('error'))
        <div class="alert alert-danger p-1 px-4 m-0">
          {{ session('error') }}
        </div>
        @endif
      </div>
    </div>
  </div>
  <div class="card-body">
    @if(!count($receptionists))
    <div class="alert alert-danger">
      * <b>DATA RESEPSIONIS</b> TIDAK ADA / BELUM DITAMBAHKAN
    </div>
    @endif
    <div class="table-responsive mb-2">
      <table class="table table-striped table-bordered data">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Username</th>
            <th scope="col">Name</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($receptionists as $key => $receptionist)
          <tr>
            <td>{{ $receptionists->firstItem() + $key }}</td>
            <td>{{ $receptionist->user->username }}</td>
            <td>{{ $receptionist->name }}</td>
            <td>
              <a href="#modal-detail" data-toggle="modal" class="btn btn-primary m-1"
                onclick="$('#modal-detail #detail-name').text('{{ $receptionist->name }}');$('#modal-detail #detail-username').text('{{ $receptionist->user->username }}');">Detail</a>
              <div class="dropdown d-inline">
                <button class="btn btn-info dropdown-toggle m-1" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Lainya
                </button>
                <div class="dropdown-menu">
                  <a href="#modal-edit" data-toggle="modal" class="dropdown-item text-warning font-weight-bold"
                    onclick="$('#modal-edit #form-edit').attr('action', '/admin/receptionists/{{ $receptionist->id }}/update');$('#modal-edit #name').attr('value', '{{ $receptionist->name }}');$('#modal-edit #username').attr('value', '{{ $receptionist->user->username }}');">Edit</a>
                  <a href=" #modal-delete" data-toggle="modal" class="dropdown-item text-danger font-weight-bold"
                    onclick="$('#modal-delete #form-delete').attr('action', '/admin/receptionists/{{ $receptionist->id }}/destroy');$('#modal-delete #delete-name').text('{{ $receptionist->name }}');$('#modal-delete #delete-username').text('{{ $receptionist->user->username }}');">Hapus</a>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="pagination">
      {{ $receptionists->links() }}
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- MODAL CREATE -->
<div class="modal fade" id="modal-create" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-create" class="modal-content" action="{{ route('admin.receptionists.store') }}" method="post"
      enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Tambah Data <span class="text-primary">
            Resepsionis</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nama <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="username">Username <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
            required>
        </div>
        <div class="form-group">
          <label for="password">Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
            name="password" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
{{-- MODAL DETAIL --}}
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Data <span class="text-primary">
            Kamar</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-primary">Informasi</h6>
        <table>
          <tr class="align-top">
            <td>Nama</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="detail-name"></td>
          </tr>
          <tr class="align-top">
            <td>Username</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="detail-username"></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- MODAL EDIT -->
<div class="modal fade" id="modal-edit" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-edit" class="modal-content" action="" method="post" enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Edit Data <span class="text-primary">
            Kamar</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name">Nama <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="username">Username <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
            required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
            name="password">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
{{-- MODAL DELETE --}}
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-delete" class="modal-content" action="" method="get">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Yakin Hapus Data <span class="text-primary">
            Resepsionis</span> Ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-primary">Informasi</h6>
        <table>
          <tr class="align-top">
            <td>Nama</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="delete-name"></td>
          </tr>
          <tr class="align-top">
            <td>Username</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="delete-username"></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>
@endsection