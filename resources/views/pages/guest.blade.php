@extends('layouts.app')

@section('content')
<section id="guest" class="py-4">
  @if(session('success'))
  <div class="container mb-4">
    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  @elseif(session('error'))
  <div class="container mb-4">
    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
      <strong>{{ session('error') }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
  @endif
  <div class="container py-4">
    <div class="guest-header pb-4 pb-md-5">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h6 class="font-weight-bold text-primary spacing-4 m-0">
          TAMU
        </h6>
        <div class="d-flex">
          <a href="#" class="font-weight-bold text-primary ml-2 border-bottom border-primary spacing-1"
            data-toggle="modal" data-target="#modal-update">PROFIL</a>
          <a href="#" class="font-weight-bold text-primary ml-2 border-bottom border-primary spacing-1 m-0"
            data-toggle="modal" data-target="#modal-logout">KELUAR</a>
        </div>
      </div>
      <h1 class="font-weight-bold text-secondary spacing-2 text-type-secondary">
        RESERVASI
      </h1>
    </div>
    <div class="guest-body">
      <a href="{{ route('checkout') }}" class="btn btn-primary mb-4">Tambah
        Reservasi</a>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Status</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Jumlah Kamar</th>
              <th>Total Harga</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $count = 1; ?>
            @foreach($reservations as $reservation)
            <tr>
              <td>{{ $count }}</td>
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
              <td>{{ $reservation->check_in }}</td>
              <td>{{ $reservation->check_out }}</td>
              <td>{{ $reservation->total_rooms }}</td>
              <td>{{ $reservation->total_cost }}</td>
              <td>
                <a href="#" class="btn btn-success">
                  Cetak
                </a>
              </td>
            </tr>
            <?php $count++ ?>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection

@section('modal')
<!-- MODAL CREATE -->
<div class="modal fade" id="modal-update">
  <div class="modal-dialog">
    <form id="form-update" class="modal-content bg-primary" action="{{ route('guest.update') }}" method="post">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title text-primary font-weight-bold spacing-1">UBAH PROFIL</h5>
        <button type="button" class="close text-secondary" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="name" class="text-primary font-weight-bold text-left spacing-1 m-0">Nama <span
              class="text-danger">*</span></label>
          <input type="text" class="form-control text-secondary @error('name') is-invalid @enderror" id="name"
            name="name" value="{{ $guest->name }}" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="email" class="text-primary font-weight-bold text-left spacing-1 m-0">Email <span
              class="text-danger">*</span>
          </label>
          <input type="email" class="form-control text-secondary @error('email') is-invalid @enderror" id="email"
            name="email" value="{{ $guest->email }}" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="phone" class="text-primary font-weight-bold text-left spacing-1 m-0">No. HP <span
              class="text-danger">*</span></label>
          <input type="number" class="form-control text-secondary @error('phone') is-invalid @enderror" id="phone"
            name="phone" value="{{ $guest->phone }}" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label for="address" class="text-primary font-weight-bold text-left spacing-1 m-0">Alamat <span
              class="text-danger">*</span></label>
          <input type="text" class="form-control text-secondary @error('address') is-invalid @enderror" id="address"
            name="address" value="{{ $guest->address }}" autocomplete="off" required>
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
<div class="modal fade" id="modal-logout">
  <div class="modal-dialog">
    <form id="form-logout" class="modal-content bg-primary" action="{{ route('logout') }}" method="get">
      <div class="modal-header">
        <h5 class="modal-title text-primary font-weight-bold spacing-1">YAKIN INGIN <span class="text-secondary">
            KELUAR</span> ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-primary">Yakin</button>
      </div>
    </form>
  </div>
</div>
@endsection