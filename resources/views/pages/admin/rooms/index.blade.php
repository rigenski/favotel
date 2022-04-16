@extends('layouts.admin')
@section('rooms', 'active')

@section('title', 'Daftar Kamar')

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
    @if(!count($rooms))
    <div class="alert alert-danger">
      * <b>DATA KAMAR</b> TIDAK ADA / BELUM DITAMBAHKAN
    </div>
    @endif
    <div class="table-responsive mb-2">
      <table class="table table-striped table-bordered data">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah Kamar</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($rooms as $key => $room)
          <tr>
            <td>{{ $rooms->firstItem() + $key }}</td>
            <td>
              <img
                src="{{ $room->image ? asset('/images/uploads/rooms/' . $room->image) : asset('/images/admin-not-found.svg') }}"
                alt="" style="max-height: 100px;max-width: 100px;">
            </td>
            <td>{{ $room->name }}</td>
            <td>{{ $room->price }}</td>
            <td>{{ $room->total_rooms }}</td>
            <td>
              <a href="#modal-detail" data-toggle="modal" class="btn btn-primary m-1"
                onclick="$('#modal-detail #detail-name').text('{{ $room->name }}');$('#modal-detail #detail-price').text('{{ $room->price }}');$('#modal-detail #detail-total_rooms').text('{{ $room->total_rooms }}');$('#modal-detail #detail-image').attr('src', '{{ $room->image ? asset('/images/uploads/rooms/' . $room->image) : asset('/images/not-found.png') }}');">Detail</a>
              <div class="dropdown d-inline">
                <button class="btn btn-info dropdown-toggle m-1" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Lainya
                </button>
                <div class="dropdown-menu">
                  <a href="#modal-edit" data-toggle="modal" class="dropdown-item text-warning font-weight-bold"
                    onclick="$('#modal-edit #form-edit').attr('action', '/admin/rooms/{{ $room->id }}/update');$('#modal-edit #name').attr('value', '{{ $room->name }}');$('#modal-edit #price').attr('value', '{{ $room->price }}');$('#modal-edit #total_rooms').attr('value', '{{ $room->total_rooms }}');">Edit</a>
                  <a href=" #modal-delete" data-toggle="modal" class="dropdown-item text-danger font-weight-bold"
                    onclick="$('#modal-delete #form-delete').attr('action', '/admin/rooms/{{ $room->id }}/destroy');$('#modal-delete #delete-name').text('{{ $room->name }}');$('#modal-delete #delete-price').text('{{ $room->price }}');;$('#modal-delete #delete-total_rooms').text('{{ $room->total_rooms }}');$('#modal-delete #delete-image').attr('src', '{{ $room->image ? asset('/images/uploads/rooms/' . $room->image) : asset('/images/not-found.png') }}');">Hapus</a>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="pagination">
      {{ $rooms->links() }}
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- MODAL CREATE -->
<div class="modal fade" id="modal-create" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-create" class="modal-content" action="{{ route('admin.rooms.store') }}" method="post"
      enctype="multipart/form-data">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Tambah Data <span class="text-primary">
            Kamar</span></h5>
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
          <label for="price">Biaya <span class="text-danger">*</span></label>
          <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
            required>
        </div>
        <div class="form-group">
          <label for="total_rooms">Jumlah Kamar <span class="text-danger">*</span></label>
          <input type="number" class="form-control @error('total_rooms') is-invalid @enderror" id="total_rooms"
            name="total_rooms" required>
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
            <td>Harga</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="detail-price"></td>
          </tr>
          <tr class="align-top">
            <td>Jumlah Kamar</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="detail-total_rooms"></td>
          </tr>
          <tr class="align-top">
            <td>Gambar</td>
            <td class="px-2">:</td>
            <td><img src="{{ asset('/images/not-found.png') }}" alt="" class="mt-2" id="detail-image">
            </td>
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
          <label for="price">Harga <span class="text-danger">*</span></label>
          <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
            required>
        </div>
        <div class="form-group">
          <label for="total_rooms">Jumlah Kamar <span class="text-danger">*</span></label>
          <input type="number" class="form-control @error('total_rooms') is-invalid @enderror" id="total_rooms"
            name="total_rooms" required>
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
    <form id="form-delete" class="modal-content" action="" method="get">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Yakin Hapus Data <span class="text-primary">
            Kamar</span> Ini ?</h5>
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
            <td>Harga</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="delete-price"></td>
          </tr>
          <tr class="align-top">
            <td>Jumlah Kamar</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="delete-total_rooms"></td>
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