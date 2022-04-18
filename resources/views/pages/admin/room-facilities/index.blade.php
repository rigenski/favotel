@extends('layouts.admin')
@section('room-facilities', 'active')

@section('title', 'Daftar Fasilitas Kamar')

@section('content')
<div class="card mb-4">
  <div class="card-header row">
    <div class="col-12 col-sm-6 p-0 my-1">
      <div class="d-flex align-items-start">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-filter">
          Filter
        </button>
        <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modal-create">
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
    @if(!count($room_facilities))
    <div class="alert alert-danger">
      * DATA FASILITAS <b>KAMAR {{ $filter->has('room_type') ? strtoupper($rooms->find($filter->room_type)->name) :
        strtoupper($rooms[0]->name) }}</b>
      TIDAK ADA
    </div>
    @endif
    <div class="table-responsive mb-2">
      <table class="table table-striped table-bordered data">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Tipe Kamar</th>
            <th scope="col">Fasilitas</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($room_facilities as $key => $room_facility)
          <tr>
            <td>{{ $room_facilities->firstItem() + $key }}</td>
            <td>{{ $room_facility->room->name }}</td>
            <td>{{ $room_facility->name }}</td>
            <td>
              <a href="#modal-detail" data-toggle="modal" class="btn btn-primary m-1"
                onclick="$('#modal-detail #detail-room_type').text('{{ $room_facility->room->name }}');$('#modal-detail #detail-facility').text('{{ $room_facility->name }}');">Detail</a>
              <div class="dropdown d-inline">
                <button class="btn btn-info dropdown-toggle m-1" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Lainya
                </button>
                <div class="dropdown-menu">
                  <a href="#modal-edit" data-toggle="modal" class="dropdown-item text-warning font-weight-bold"
                    onclick="$('#modal-edit #form-edit').attr('action', '/admin/room-facilities/{{ $room_facility->id }}/update');$('#modal-edit #room_type--select').attr('value', '{{ $room_facility->room->id }}');$('#modal-edit #room_type--select').text('{{ $room_facility->room->name }}');$('#modal-edit #facility').attr('value', '{{ $room_facility->name }}');">Edit</a>
                  <a href="#modal-delete" data-toggle="modal" class="dropdown-item text-danger font-weight-bold"
                    onclick="$('#modal-delete #form-delete').attr('action', '/admin/room-facilities/{{ $room_facility->id }}/destroy');$('#modal-delete #delete-room_type').text('{{ $room_facility->room->name }}');$('#modal-delete #delete-facility').text('{{ $room_facility->name }}');">Hapus</a>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="pagination">
      @if($filter->room_type)
      {{ $room_facilities->appends(['room_type' => $filter->room_type ? $filter->room_type : ''])->links() }}
      @else
      {{ $room_facilities->links() }}
      @endif
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- MODAL FILTER -->
<div class="modal fade" id="modal-filter" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="filter-form" class="modal-content" action="" method="get">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Filter Data <span class="text-primary">Fasilitas
            Kamar</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="room_type">Tipe Kamar <span class="text-danger">*</span></label>
          <select class="form-control @error('name') is-invalid @enderror" name="room_type" id="room_type">
            @if($filter->has('room_type'))
            <option value="{{ $rooms->find($filter->room_type)->id }}">{{ $rooms->find($filter->room_type)->name }}
            </option>
            @foreach($rooms as $room)
            @if($filter->room_type != $room->id)
            <option value="{{ $room->id }}">{{ $room->name }}</option>
            @endif
            @endforeach
            @else
            @foreach($rooms as $room)
            <option value="{{ $room->id }}">{{ $room->name }}</option>
            @endforeach
            @endif
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Cari</button>
      </div>
    </form>
  </div>
</div>
<!-- MODAL CREATE -->
<div class="modal fade" id="modal-create" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-create" class="modal-content" action="{{ route('admin.room-facilities.store') }}" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Tambah Data <span class="text-primary">Fasilitas
            Kamar</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="room_type">Tipe Kamar <span class="text-danger">*</span></label>
          <select class="form-control @error('name') is-invalid @enderror" name="room_type" id="room_type">
            @foreach($rooms as $data)
            <option value="{{ $data->id }}">{{ $data->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="facility">Fasilitas <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('facility') is-invalid @enderror" id="facility" name="facility"
            required>
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
            <td>Tipe Kamar</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="detail-room_type"></td>
          </tr>
          <tr class="align-top">
            <td>Fasilitas</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="detail-facility"></td>
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
    <form id="form-edit" class="modal-content" action="" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Edit Data <span class="text-primary">Fasilitas
            Kamar</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="room_type">Tipe Kamar <span class="text-danger">*</span></label>
          <select class="form-control @error('name') is-invalid @enderror" name="room_type" id="room_type">
            <option value="" id="room_type--select" class="bg-secondary"></option>
            @foreach($rooms as $data)
            <option value="{{ $data->id }}">{{ $data->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="facility">Fasilitas <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('facility') is-invalid @enderror" id="facility" name="facility"
            required>
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
        <h5 class="modal-title text-dark" id="exampleModalLabel">Yakin Hapus Data <span class="text-primary">Fasilitas
            Kamar</span> Ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-primary">Informasi</h6>
        <table>
          <tr class="align-top">
            <td>Tipe Kamar</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="delete-room_type"></td>
          </tr>
          <tr class="align-top">
            <td>Fasilitas</td>
            <td class="px-2">:</td>
            <td class="font-weight-bold text-dark" id="delete-facility"></td>
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