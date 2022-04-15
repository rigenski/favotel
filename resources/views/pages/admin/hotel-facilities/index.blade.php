@extends('layouts.admin')
@section('hotel-facilities', 'active')

@section('title', 'Daftar Fasilitas Hotel')

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
    @if(!count($hotel_facilities))
    <div class="alert alert-danger">
      * <b>DATA FASILITAS HOTEL</b> TIDAK ADA / BELUM DITAMBAHKAN
    </div>
    @endif
    <div class="table-responsive">
      <table class="table table-striped table-bordered data">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $count = 1; ?>
          @foreach ($hotel_facilities as $data)
          <tr>
            <td>{{ $count }}</td>
            <td>
              <img
                src="{{ $data->image ? asset('/images/uploads/hotel-facilities/' . $data->image) : asset('/images/admin-not-found.svg') }}"
                alt="" style="max-height: 100px;max-width: 100px;">
            </td>
            <td>{{ $data->name }}</td>
            <td>{{ substr( $data->description, 0, 40) }}</td>
            <td>
              <a href="#modal-detail" data-toggle="modal" class="btn btn-primary m-1"
                onclick="$('#modal-detail #detail-name').text('{{ $data->name }}');$('#modal-detail #detail-description').text('{{ $data->description }}');$('#modal-detail #detail-image').attr('src', '{{ $data->image ? asset('/images/uploads/hotel-facilities/' . $data->image) : asset('/images/not-found.png') }}');">Detail</a>
              <div class="dropdown d-inline">
                <button class="btn btn-info dropdown-toggle m-1" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Lainya
                </button>
                <div class="dropdown-menu">
                  <a href="#modal-edit" data-toggle="modal" class="dropdown-item text-warning font-weight-bold"
                    onclick="$('#modal-edit #form-edit').attr('action', '/admin/hotel-facilities/{{ $data->id }}/update');$('#modal-edit #name').attr('value', '{{ $data->name }}');$('#modal-edit #description').attr('value', '{{ $data->description }}');">Edit</a>
                  <a href="#modal-delete" data-toggle="modal" class="dropdown-item text-danger font-weight-bold"
                    onclick="$('#modal-delete #form-delete').attr('action', '/admin/hotel-facilities/{{ $data->id }}/destroy');$('#modal-delete #delete-name').text('{{ $data->name }}');$('#modal-delete #delete-description').text('{{ $data->description }}');$('#modal-delete #delete-image').attr('src', '{{ $data->image ? asset('/images/uploads/hotel-facilities/' . $data->image) : asset('/images/not-found.png') }}');">Hapus</a>
                </div>
              </div>
            </td>
          </tr>
          <?php $count++ ?>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- MODAL CREATE -->
<div class="modal fade" id="modal-create" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="create-form" class="modal-content" action="{{ route('admin.hotel-facilities.store') }}" method="post"
      enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Tambah Data <span class="text-primary">Fasilitas
            Hotel</span></h5>
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
          <label for="description">Keterangan <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
            name="description" required>
        </div>
        <div class="form-group">
          <label for="image">Gambar</label>
          <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
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
        <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Data <span class="text-primary">Fasilitas
            Hotel</span></h5>
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
            <td>Keterangan</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="detail-description"></td>
          </tr>
          <tr class="align-top">
            <td>Gambar</td>
            <td class="px-2">:</td>
            <td><img src="" alt="" class="mt-2" id="detail-image">
            </td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
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
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Edit Data <span class="text-primary">Fasilitas
            Hotel</span></h5>
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
          <label for="description">Keterangan <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('description') is-invalid @enderror" id="description"
            name="description" required>
        </div>
        <div class="form-group">
          <label for="image">Gambar</label>
          <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
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
    <form id="form-delete" action="" method="get" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Yakin Hapus Data <span class="text-primary">Fasilitas
            Hotel</span> Ini ?</h5>
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
            <td>Keterangan</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="delete-description"></td>
          </tr>
          <tr class="align-top">
            <td>Gambar</td>
            <td class="px-2">:</td>
            <td><img src="" alt="" class="mt-2" id="delete-image">
            </td>
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