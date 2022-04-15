@extends('layouts.admin')
@section('reservations', 'active')

@section('title', 'Daftar Reservasi')

@section('content')
<div class="card mb-4">
  <div class="card-header row">
    <div class="col-12 col-sm-6 p-0 my-1">
      <div class="d-flex align-items-start">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-filter">
          Filter
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
    @if(!count($reservations))
    <div class="alert alert-danger">
      * <b>DATA RESERVASI</b> TIDAK ADA / BELUM DITAMBAHKAN
    </div>
    @endif
    <div class="table-responsive">
      <table class="table table-striped table-bordered data">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Tamu</th>
            <th scope="col">Jumlah Kamar</th>
            <th scope="col">Tanggal Check In</th>
            <th scope="col">Tanggal Check Out</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $count = 1; ?>
          @foreach ($reservations as $data)
          <tr>
            <td>{{ $count }}</td>
            @if($data->guest)
            <td>{{ $data->guest->name }}</td>
            @else
            <td class="font-weight-bold text-danger">Data Belum Lengkap</td>
            @endif
            <td>{{ $data->total_rooms }}</td>
            <td>{{ date('d-m-Y', strtotime($data->check_in)) }}</td>
            <td>{{ date('d-m-Y', strtotime($data->check_out)) }}</td>
            <td>
              <a href="#modal-detail" data-toggle="modal" class="btn btn-primary mr-2"
                onclick="$('#modal-detail #detail-check_in').text('{{ $data->check_in }}');$('#modal-detail #detail-check_out').text('{{ $data->check_out }}');$('#modal-detail #detail-total_rooms').text('{{ $data->total_rooms }}');$('#modal-detail #detail-guest').text('{{ $data->guest->name }}');$('#modal-detail #detail-email').text('{{ $data->guest->email }}');$('#modal-detail #detail-phone').text('{{ $data->guest->phone }}');$('#modal-detail #detail-room_type').text('{{ $data->room->name }}');">Detail</a>
              <div class="dropdown d-inline">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Lainya
                </button>
                <div class="dropdown-menu">
                  <a href="#modal-delete" data-toggle="modal" class="dropdown-item text-danger font-weight-bold"
                    onclick="$('#modal-delete #form-delete').attr('action', '/admin/reservations/{{ $data->id }}/destroy');$('#modal-delete #delete-check_in').text('{{ $data->check_in }}');$('#modal-delete #delete-check_out').text('{{ $data->check_out }}');$('#modal-delete #delete-total_rooms').text('{{ $data->total_rooms }}');$('#modal-delete #delete-guest').text('{{ $data->guest->name }}');$('#modal-delete #delete-email').text('{{ $data->guest->email }}');$('#modal-delete #delete-phone').text('{{ $data->guest->phone }}');$('#modal-delete #delete-room_type').text('{{ $data->room->name }}');">Hapus</a>
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
<!-- MODAL FILTER -->
<div class="modal fade" id="modal-filter" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-create" class="modal-content" action="" method="get">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Filter Data <span
            class="text-primary">Reservasi</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="room_type">Tipe <span class="text-danger">*</span></label>
          <select class="form-control @error('name') is-invalid @enderror" name="room_type" id="room_type">
            <option value="Medium">Check-In</option>
            <option value="Basic">Nama Tamu</option>
          </select>
        </div>
        <div class="form-group">
          <label for="check-in">Check-In <span class="text-danger">*</span></label>
          <input type="date" class="form-control @error('check-in') is-invalid @enderror" id="check-in" name="check-in"
            required>
        </div>
        <div class="form-group">
          <label for="guest">Nama Tamu <span class="text-danger">*</span></label>
          <input type="text" class="form-control @error('guest') is-invalid @enderror" id="guest" name="guest" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
        <button type="submit" class="btn btn-primary">Cari</button>
      </div>
    </form>
  </div>
</div>
{{-- MODAL DETAIL --}}
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Detail Data <span class="text-primary">Reservasi</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-primary">Informasi</h6>
        <table>
          <tr class="align-top">
            <td>Tanggal Check-in</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-check_in"></b></td>
          </tr>
          <tr class="align-top">
            <td>Tanggal Check-out</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-check_out"></b></td>
          </tr>
          <tr class="align-top">
            <td>Jumlah Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-total_rooms"></b></td>
          </tr>
          <tr class="align-top">
            <td>Nama Tamu</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-guest"></b></td>
          </tr>
          <tr class="align-top">
            <td>Email</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-email"></b></td>
          </tr>
          <tr class="align-top">
            <td>No. HP</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-phone"></b></td>
          </tr>
          <tr class="align-top">
            <td>Tipe Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-room_type"></b></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
{{-- MODAL DELETE --}}
<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-delete" class="modal-content" action="" method="get">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Yakin Hapus Data <span
            class="text-primary">Reservasi</span> Ini ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-primary">Informasi</h6>
        <table>
          <tr class="align-top">
            <td>Tanggal Check-in</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-check_in"></b></td>
          </tr>
          <tr class="align-top">
            <td>Tanggal Check-out</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-check_out"></b></td>
          </tr>
          <tr class="align-top">
            <td>Jumlah Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-total_rooms"></b></td>
          </tr>
          <tr class="align-top">
            <td>Nama Tamu</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-guest"></b></td>
          </tr>
          <tr class="align-top">
            <td>Email</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-email"></b></td>
          </tr>
          <tr class="align-top">
            <td>No. HP</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-phone"></b></td>
          </tr>
          <tr class="align-top">
            <td>Tipe Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="delete-room_type"></b></td>
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
</div>
@endsection