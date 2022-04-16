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
    <div class="table-responsive mb-2">
      <table class="table table-striped table-bordered data">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Status</th>
            <th scope="col">Nama Tamu</th>
            <th scope="col">Tanggal Check In</th>
            <th scope="col">Tanggal Check Out</th>
            <th scope="col">Total Kamar</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($reservations as $key => $reservation)
          <tr>
            <td>{{ $reservations->firstItem() + $key }}</td>
            <td>
              @if($reservation->status == 'process')
              <span class="badge badge-warning">
                PROSES
              </span>
              @elseif($reservation->status == 'check-in')
              <span class="badge badge-success">
                CHECK-IN
              </span>
              @elseif($reservation->status == 'check-out')
              <span class="badge badge-info">
                CHECK-OUT
              </span>
              @elseif($reservation->status == 'cancel')
              <span class="badge badge-danger">
                BATAL
              </span>
              @endif
            </td>
            <td>{{ $reservation->guest_name }}</td>
            <td>{{ date('d-m-Y', strtotime($reservation->check_in)) }}</td>
            <td>{{ date('d-m-Y', strtotime($reservation->check_out)) }}</td>
            <td>{{ $reservation->total_rooms }}</td>
            <?php
                $first_day = new DateTime($reservation->check_in);
                $last_day = new DateTime($reservation->check_out);
                $interval = $first_day->diff($last_day);
                $total_days = $interval->format('%a');

                $total_price = $reservation->room->price * $reservation->total_rooms * $total_days;
              ?>
            <td>Rp. {{ $total_price }}</td>
            <td>
              <a href="#modal-detail" data-toggle="modal" class="btn btn-primary m-1"
                onclick="$('#modal-detail #detail-guest').text('{{ $reservation->guest_name }}');$('#modal-detail #detail-email').text('{{ $reservation->email }}');$('#modal-detail #detail-phone').text('{{ $reservation->phone }}');$('#modal-detail #detail-check_in').text('{{ $reservation->check_in }}');$('#modal-detail #detail-check_out').text('{{ $reservation->check_out }}');$('#modal-detail #detail-room_type').text('{{ $reservation->room->name }}');$('#modal-detail #detail-total_rooms').text('{{ $reservation->total_rooms }}');$('#modal-detail #detail-total_days').text('{{ $total_days }}');$('#modal-detail #detail-total_rooms2').text('{{ $reservation->total_rooms }}');$('#modal-detail #detail-room_price').text('{{ $reservation->room->price }}');$('#modal-detail #detail-total_price').text('{{ $total_price }}');">Detail</a>
              <a href="#modal-edit" data-toggle="modal" class="btn btn-warning m-1"
                onclick="$('#modal-edit #edit-guest').text('{{ $reservation->guest_name }}');$('#modal-edit #edit-email').text('{{ $reservation->email }}');$('#modal-edit #edit-phone').text('{{ $reservation->phone }}');$('#modal-edit #edit-check_in').text('{{ $reservation->check_in }}');$('#modal-edit #edit-check_out').text('{{ $reservation->check_out }}');$('#modal-edit #edit-room_type').text('{{ $reservation->room->name }}');$('#modal-edit #edit-total_rooms').text('{{ $reservation->total_rooms }}');$('#modal-edit #edit-total_price').text('{{ $total_price }}');$('#modal-edit #form-edit').attr('action', '/admin/reservations/{{ $reservation->id }}/update');$('#modal-edit #status--select').text('{{ $reservation->status == 'process' ? 'PROSES' : ( $reservation->status == 'check-in' ? 'CHECK-IN' : ( $reservation->status == 'check-out' ? 'CHECK-OUT' : ( $reservation->status == 'cancel' ? 'CANCEL ' : '' ) ) ) }}');$('#modal-edit #status--select').attr('value', '{{ $reservation->status }}');">Edit</a>
              <a href="{{ route('admin.reservations.print', ['id' => $reservation->id]) }}"
                class="btn btn-success m-1">Cetak</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="pagination">
      {{ $reservations->appends(['check_in' => $filter->check_in ? $filter->check_in : '', 'guest' => $filter->guest
      ? $filter->guest : '' ])->links() }}
    </div>
  </div>
</div>
@endsection

@section('modal')
<!-- MODAL FILTER -->
<div class="modal fade" id="modal-filter" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-create" class="modal-content" action="{{ route('admin.reservations') }}" method="get">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="staticBackdropLabel">Filter Data <span
            class="text-primary">Reservasi</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="check-in">Tanggal Check-In</label>
          <input type="date" class="form-control @error('check-in') is-invalid @enderror" id="check_in" name="check_in"
            value="{{ $filter->check_in ? $filter->check_in : '' }}">
        </div>
        <div class=" form-group">
          <label for="guest">Nama Tamu</label>
          <input type="text" class="form-control @error('guest') is-invalid @enderror" id="guest" name="guest"
            value="{{ $filter->guest ? $filter->guest : '' }}">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <a href="{{ route('admin.reservations') }}" class="btn btn-warning m-0"><i class="fas fa-retweet"></i></a>
        <div>
          <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Kembali</button>
          <button type="submit" class="btn btn-primary">Cari</button>
        </div>
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
        <h6 class="text-primary">Detail Tamu</h6>
        <table class="mb-4">
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
        </table>
        <h6 class="text-primary">Detail Reservasi</h6>
        <table class="mb-4">
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
            <td>Tipe Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-room_type"></b></td>
          </tr>
          <tr class="align-top">
            <td>Total Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-total_rooms"></b></td>
          </tr>
        </table>
        <h6 class="text-primary">Detail Pembelian</h6>
        <table class="mb-4">
          <tr class="align-top">
            <td>Total Hari</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-total_days"></b></td>
          </tr>
          <tr class="align-top">
            <td>Total Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-total_rooms2"></b></td>
          </tr>
          <tr class="align-top">
            <td>Harga Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-room_price"></b></td>
          </tr>
          <tr class="align-top">
            <td>Jumlah</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="detail-total_price"></b></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
{{-- MODAL EDIT --}}
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-edit" class="modal-content" action="" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel">Edit Data <span class="text-primary">Reservasi</span>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center text-primary">Informasi</h6>
        <table class="mb-4">
          <tr class="align-top">
            <td>Nama Tamu</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="edit-guest"></b></td>
          </tr>
          <tr class="align-top">
            <td>Email</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="edit-email"></b></td>
          </tr>
          <tr class="align-top">
            <td>No. HP</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="edit-phone"></b></td>
          </tr>
          <tr class="align-top">
            <td>Tanggal Check-in</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="edit-check_in"></b></td>
          </tr>
          <tr class="align-top">
            <td>Tanggal Check-out</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="edit-check_out"></b></td>
          </tr>
          <tr class="align-top">
            <td>Tipe Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="edit-room_type"></b></td>
          </tr>
          <tr class="align-top">
            <td>Total Kamar</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="edit-total_rooms"></b></td>
          </tr>
          <tr class="align-top">
            <td>Jumlah</td>
            <td class="px-2">:</td>
            <td><b class="text-dark" id="edit-total_price"></b></td>
          </tr>
        </table>
        <div class="form-group">
          <label for="status">Status</label>
          <select class="form-control @error('name') is-invalid @enderror" name="status" id="status">
            <option value="" id="status--select" class="bg-secondary"></option>
            @foreach($status as $data)
            <option value="{{ $data }}">{{ $data == 'process' ? 'PROSES' : ( $data == 'check-in' ? 'CHECK-IN' : ( $data
              ==
              'check-out' ? 'CHECK-OUT' : ( $data == 'cancel' ? 'CANCEL ' : '' ) ) ) }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection